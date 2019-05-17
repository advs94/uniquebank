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
    loadMyKNN();
}

function draw() {
    background(0);
    image(video, 0, 0, 640, 500);
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
    label = result['label'];
    console.log(result);
    predict();
}

function loadMyKNN() {
    knnClassifier.load('./myKNNDataset.json');
    predict();
}