let mobilenet;
let classifier;
let video;
let label = 'loading model';
let happyButton;
let sadButton;
let saveButton;
let trainButton;

function modelReady() {
  console.log('Model is ready!!!');
}

function customModelReady() {
  console.log('Custom Model is ready!!!');
  label = 'model ready';
  classifier.classify(gotResults);
}

function videoReady() {
  console.log('Video is ready!!!');
  // classifier.load('model.json', customModelReady);
}

function setup() {
  createCanvas(320, 270);
  video = createCapture(VIDEO);
  video.hide();
  background(0);
  mobilenet = ml5.featureExtractor('MobileNet', modelReady);
  classifier = mobilenet.classification(video, videoReady);

  happyButton = createButton('happy');
  happyButton.mousePressed(function() {
    classifier.addImage('happy');
  });
  
  sadButton = createButton('sad');
  sadButton.mousePressed(function() {
    classifier.addImage('sad');
  });
 
  trainButton = createButton('train');
  trainButton.mousePressed(function() {
    classifier.train(whileTraining);
  });
  
  saveButton = createButton('save');
  saveButton.mousePressed(function() {
    classifier.save();
  });

  loadButton = createButton('load');
  loadButton.mousePressed(function() {
    classifier.load('model.json', customModelReady);
  });
}

function draw() {
    background(0);
    image(video, 0, 0, 320, 240);
    fill(255);
    textSize(16);
    text(label, 10, height - 10);
}

function whileTraining(loss) {
  if(loss == null) {
    console.log('Training Complete');
    classifier.classify(gotResults);
  } else {
    console.log(loss);
  }
}

function gotResults(error, result) {
  if(error) {
    console.error(error);
  } else {
    label = result;
    classifier.classify(gotResults);
  }
}
