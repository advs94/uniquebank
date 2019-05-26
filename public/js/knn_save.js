let video;
let label = 'Need training data';
let confirmation = 'Click OK after saving'
let knnClassifier;
let featureExtractor;
let features;
let happylabel = 0;
let sadlabel = 0;

function modelReady()
{
    console.log('Model is ready!!!');
}

function setup()
{
    var cnv = createCanvas(640, 540);
    //cnv.style('display', 'block');
    var x = (windowWidth - width) / 2;
    var y = (windowHeight - height) / 2;
    cnv.position(x, y);
    video = createCapture(VIDEO);
    video.size(640, 500);
    video.hide();
    background(0);
    knnClassifier = ml5.KNNClassifier();
    featureExtractor = ml5.featureExtractor("MobileNet", modelReady);
    addButtons();
}

function draw()
{
    background(0);
    image(video, 0, 0, 640, 500);
    fill(255);
    textSize(16);
    text(label, 10, height - 15);
    text(confirmation, 480, height - 15);
}

function left()
{
    features = featureExtractor.infer(video);
    knnClassifier.addExample(features, 'left');
    console.log('left');
}

function right()
{
    features = featureExtractor.infer(video);
    knnClassifier.addExample(features, 'right');
    console.log('right');
}

function happy()
{
    features = featureExtractor.infer(video);
    knnClassifier.addExample(features, 'happy');
    console.log('happy');
}

function sad()
{
    features = featureExtractor.infer(video);
    knnClassifier.addExample(features, 'sad');
    console.log('sad');
}

function ok()
{
    window.location=document.referrer;
}

function addButtons() {
    // happyButton = createButton('Happy Example');
    // // happyButton.position(x, y);
    // happyButton.mousePressed(function() {
    //     features = featureExtractor.infer(video);
    //     knnClassifier.addExample(features, 'happy');
    //     console.log('happy');
    // });
    
    // sadButton = createButton('Sad Example');
    // // sadButton.position(x, y);
    // sadButton.mousePressed(function() {
    //     features = featureExtractor.infer(video);
    //     knnClassifier.addExample(features, 'sad');
    //     console.log('sad');
    // });

    // neutralButton = createButton('Neutral Example');
    // // neutralButton.position(x, y);
    // neutralButton.mousePressed(function() {
    //     features = featureExtractor.infer(video);
    //     knnClassifier.addExample(features, 'neutral');
    //     console.log('neutral');
    // });

    // leftButton = createButton('Left Example');
    // // leftButton.position(x, y);
    // leftButton.mousePressed(function() {
    //     features = featureExtractor.infer(video);
    //     knnClassifier.addExample(features, 'left');
    //     console.log('left');
    // });

    // rightButton = createButton('Right Example');
    // // rightButton.position(x, y);
    // rightButton.mousePressed(function() {
    //     features = featureExtractor.infer(video);
    //     knnClassifier.addExample(features, 'right');
    //     console.log('right');
    // });
    
    // predictButton = createButton('Start Predicting');
    // // predictButton.position(x, y);
    // predictButton.mousePressed(function() {
    //     predict();
    // });
    
    // saveButton = createButton('Save Dataset');
    // // saveButton.position(x, y);
    // saveButton.mousePressed(saveMyKNN);

    // okButton = createButton('OK');
    // // okButton.position(x, y);
    // okButton.mousePressed(function() {
    //     window.location=document.referrer;
    // });

    // loadButton = createButton('Load Dataset');
    // // loadButton.position(x, y);
    // loadButton.mousePressed(loadMyKNN);
}

function predict() {
    features = featureExtractor.infer(video);
    knnClassifier.classify(features, gotResult);
}

function gotResult(error, result) {
    if(error) {
        console.error(error);
    }
    label = result['label'];
    console.log(result);
    predict();
}

function saveMyKNN() {
    // const url = 'process.php'
    // const form = document.querySelector('form')

    // form.addEventListener('submit', e => {
    //     e.preventDefault()

    //     const files = document.querySelector('[type=file]').files
    //     const formData = new FormData()
    //     formData.append('file', file)

    //     fetch(url, {
    //         method: 'POST',
    //         body: formData,
    //     }).then(response => {
    //         console.log(response)
    //     })
    // })
    
}

function loadMyKNN() {
    knnClassifier.load('./myKNNDataset.json');
}