let mobilenet;
let puffin;

function modelReady() {
  console.log('Model is ready!!!');
}

function imageReady() {
  image(puffin, 0, 0, width, height);
  mobilenet.predict(puffin, gotResults);
}

function gotResults(error, results) {
  if(error0) {
    console.error(error);
  } else {
    console.log(results);
    let label = results[0].className;
    let prob = results[0].probability;
    fill(0);
    textSize(64);
    text(label, 10, height - 100);
    createP(label);
    createP(prob);
  }
}

function setup() {
  createCanvas(640, 480);
  puffin = createImg('js/puffin.jpg', imageReady);
  puffin.hide();
  background(0);
  image(puffin, 0, 0);
  mobilenet = ml5.imageClassifier('MobileNet', modelready);
}