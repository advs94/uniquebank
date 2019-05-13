let video;
let label = 'Need training data';
let knnClassifier;
let featureExtractor;
let features;
let happylabel = 0;
let sadlabel = 0;

function modelReady() {
    console.log('Model is ready!!!');
}

function setup() {
    createCanvas(320, 270);
    video = createCapture(VIDEO);
    video.size(320, 240);
    video.hide();
    background(0);
    knnClassifier = ml5.KNNClassifier();
    featureExtractor = ml5.featureExtractor("MobileNet", modelReady);
    addButtons();
}

function draw() {
    background(0);
    image(video, 0, 0, 320, 240);
    fill(255);
    textSize(16);
    text(label, 10, height - 10);
}

function addButtons() {
    happyButton = createButton('Happy Example');
    happyButton.mousePressed(function() {
        features = featureExtractor.infer(video);
        knnClassifier.addExample(features, 'happy');
        console.log('happy');
    });
    
    sadButton = createButton('Sad Example');
    sadButton.mousePressed(function() {
        features = featureExtractor.infer(video);
        knnClassifier.addExample(features, 'sad');
        console.log('sad');
    });
    
    predictButton = createButton('Start Predicting');
    predictButton.mousePressed(function() {
        predict();
    });
    
    saveButton = createButton('Save Dataset');
    saveButton.mousePressed(saveMyKNN);

    loadButton = createButton('Load Dataset');
    loadButton.mousePressed(loadMyKNN);
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
  knnClassifier.save('myKNNDataset');
}

function loadMyKNN() {
  knnClassifier.load('./myKNNDataset.json');
}