let video;
let knnClassifier;
let featureExtractor;
let features;
let happylabel = 0;
let sadlabel = 0;
let label = 'Raise your left hand for 3 seconds';
let left = 0;
let right = 0;

function modelReady() {
    console.log('Model is ready!!!');
}

function setup() {
    var cnv = createCanvas(660, 520);
    //cnv.style('display', 'block');
    var x = (windowWidth - width - 90) / 2;
    var y = (windowHeight - height) / 2;
    cnv.position(x, y);
    video = createCapture(VIDEO);
    video.size(640, 470);
    video.hide();
    background(0);
    knnClassifier = ml5.KNNClassifier();
    featureExtractor = ml5.featureExtractor("MobileNet", modelReady);
    setTimeout(function() {
        loadMyKNN();
    }, 1000);
}

function draw() {
    background(0);
    x = (windowWidth - width - 1240) / 2;
    y = (windowHeight - height - 430) / 2;
    image(video, x, y, 640, 470);
    fill(255);
    textSize(16);
    text(label, 10, height - 15);
}

function predict() {
    features = featureExtractor.infer(video);
    knnClassifier.classify(features, gotResult);
}

function gotResult(error, result) {
    if(error) {
        console.error(error);
    }
    // label = result['label'];
    // console.log(result);
    console.log(result['label']);
    // console.log('left' + left + ' | right' + right);

    if(result['label'].localeCompare('right') == 0)
    {
        left = 0;
        right++;
    }
    else if(result['label'].localeCompare('left') == 0) 
    {
        left++;
        right = 0;
    }
    else
    {
        left = 0;
        right = 0;
    }

    if(left == 110)
    {
        label = 'Raise your right hand and close it for 3 seconds';
    }

    if(right == 110 && label.localeCompare('Raise your right hand and close it for 3 seconds') == 0)
    {
        window.location.href = 'http://localhost:8000/login' + '?' + 'email=' + userEmail;
        asd;
    }

    predict();
}

function loadMyKNN() {
    knnClassifier.load('./myKNN.json');
    setTimeout(function() {
        predict();
    }, 1000);
}