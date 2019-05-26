let canvas;
let video;
let x;
let y;
let poseNet;
let pose;
let poses = [];
let skeletons = [];
let json;
let distance = [];
let img;

function videoReady()
{
    console.log('Video is ready !');
}

function modelReady()
{
    console.log('Model is ready !');
}

function poseReady()
{
    console.log('Pose is ready !');
}

function setup()
{
    canvas = createCanvas(640, 500);
    x = (windowWidth - width) / 2;
    y = (windowHeight - height) / 2;
    canvas.position(x, y);
    video = createCapture(VIDEO, videoReady);
    video.size(640, 500);

    poseNet = ml5.poseNet(video, modelReady);
    poseNet.on('pose', function (results) {
        poses = results;
        gotPoses();
    });

    video.hide();
}

function draw()
{
    image(video, 0, 0, 640, 500);

    drawKeypoints();
    drawSkeleton();
}

function ok()
{
    img = video.get();
    img.loadPixels();
    console.log(img.pixels);
}

function drawKeypoints()  {
    // Loop through all the poses detected
    for (let i = 0; i < poses.length; i++) {
        // For each pose detected, loop through all the keypoints
        for (let j = 0; j < poses[i].pose.keypoints.length; j++) {
            // A keypoint is an object describing a body part (like rightArm or leftShoulder)
            let keypoint = poses[i].pose.keypoints[j];
            // Only draw an ellipse is the pose probability is bigger than 0.2
            if (keypoint.score > 0.2) {
                fill(255, 0, 0);
                noStroke();
                ellipse(keypoint.position.x, keypoint.position.y, 10, 10);
            }
        }
    }
}
  
function drawSkeleton() {
    // Loop through all the skeletons detected
    for (let i = 0; i < poses.length; i++) {
        // For every skeleton, loop through all body connections
        for (let j = 0; j < poses[i].skeleton.length; j++) {
            let partA = poses[i].skeleton[j][0];
            let partB = poses[i].skeleton[j][1];
            stroke(255, 0, 0);
            line(partA.position.x, partA.position.y, partB.position.x, partB.position.y);
        }
    }
}

function gotPoses()
{
    if(img)
    {
        console.log('Image is ready !');
    }

    console.log(poses);
}

function save2()
{
    // 0 = nose to left eye
    distance[0];
    // 1 = nose to right eye
    distance[0];
    // 2 = nose to left ear
    distance[0];
    // 3 = nose to right ear
    distance[0];
    // 4 = nose to left shoulder
    distance[0];
    // 5 = nose to right shoulder
    distance[0];

    history.pushState({}, "", "what");
    window.location.href = window.location.href + "?" + "x0=" + poses[0].pose.keypoints[0].position.x + "&"
                                                      + "y0=" + poses[0].pose.keypoints[0].position.y + "&"
                                                      + "x1=" + poses[0].pose.keypoints[1].position.x + "&"
                                                      + "y1=" + poses[0].pose.keypoints[1].position.y + "&"
                                                      + "x2=" + poses[0].pose.keypoints[2].position.x + "&"
                                                      + "y2=" + poses[0].pose.keypoints[2].position.y + "&"
                                                      + "x3=" + poses[0].pose.keypoints[3].position.x + "&"
                                                      + "y3=" + poses[0].pose.keypoints[3].position.y + "&"
                                                      + "x4=" + poses[0].pose.keypoints[4].position.x + "&"
                                                      + "y4=" + poses[0].pose.keypoints[4].position.y;
}