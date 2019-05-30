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
    distance[0] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y));
    // 1 = nose to right eye
    distance[1] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y));
    // 2 = nose to left ear
    distance[2] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y));
    // 3 = nose to right ear
    distance[3] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y));
    // 4 = nose to left shoulder
    distance[4] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y));
    // 5 = nose to right shoulder
    distance[5] = int(dist(poses[0].pose.keypoints[0].position.x, poses[0].pose.keypoints[0].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    // 6 = left eye to right eye
    distance[6] = int(dist(poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y, poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y));
    // 7 = left eye to left ear
    distance[7] = int(dist(poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y, poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y));
    // 8 = left eye to right ear
    distance[8] = int(dist(poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y, poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y));
    // 9 = left eye to left shoulder
    distance[9] = int(dist(poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y, poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y));
    // 10 = left eye to right shoulder
    distance[10] = int(dist(poses[0].pose.keypoints[1].position.x, poses[0].pose.keypoints[1].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    // 11 = right eye to left ear
    distance[11] = int(dist(poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y, poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y));
    // 12 = right eye to right ear
    distance[12] = int(dist(poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y, poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y));
    // 13 = right eye to left shoulder
    distance[13] = int(dist(poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y, poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y));
    // 14 = right eye to right shoulder
    distance[14] = int(dist(poses[0].pose.keypoints[2].position.x, poses[0].pose.keypoints[2].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    // 15 = left ear to right ear
    distance[15] = int(dist(poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y, poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y));
    // 16 = left ear to left shoulder
    distance[16] = int(dist(poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y, poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y));
    // 17 = left ear to right shoulder
    distance[17] = int(dist(poses[0].pose.keypoints[3].position.x, poses[0].pose.keypoints[3].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    // 18 = right ear to left shoulder
    distance[18] = int(dist(poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y, poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y));
    // 19 = right ear to right shoulder
    distance[19] = int(dist(poses[0].pose.keypoints[4].position.x, poses[0].pose.keypoints[4].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    // 20 = left shoulder to right shoulder
    distance[20] = int(dist(poses[0].pose.keypoints[5].position.x, poses[0].pose.keypoints[5].position.y, poses[0].pose.keypoints[6].position.x, poses[0].pose.keypoints[6].position.y));
    

    history.pushState({}, "", "store");
    window.location.href = window.location.href + "?" // + "x0=" + int(poses[0].pose.keypoints[0].position.x) + "&"
                                                    //   + "y0=" + int(poses[0].pose.keypoints[0].position.y) + "&"
                                                    //   + "x1=" + int(poses[0].pose.keypoints[1].position.x) + "&"
                                                    //   + "y1=" + int(poses[0].pose.keypoints[1].position.y) + "&"
                                                    //   + "x2=" + int(poses[0].pose.keypoints[2].position.x) + "&"
                                                    //   + "y2=" + int(poses[0].pose.keypoints[2].position.y) + "&"
                                                    //   + "x3=" + int(poses[0].pose.keypoints[3].position.x) + "&"
                                                    //   + "y3=" + int(poses[0].pose.keypoints[3].position.y) + "&"
                                                    //   + "x4=" + int(poses[0].pose.keypoints[4].position.x) + "&"
                                                    //   + "y4=" + int(poses[0].pose.keypoints[4].position.y) + "&"
                                                    //   + "x5=" + int(poses[0].pose.keypoints[5].position.x) + "&"
                                                    //   + "y5=" + int(poses[0].pose.keypoints[5].position.y) + "&"
                                                    //   + "x6=" + int(poses[0].pose.keypoints[6].position.x) + "&"
                                                    //   + "y6=" + int(poses[0].pose.keypoints[6].position.y) + "&"
                                                      + "d0=" + distance[0] + "&"
                                                      + "d1=" + distance[1] + "&"
                                                      + "d2=" + distance[2] + "&"
                                                      + "d3=" + distance[3] + "&"
                                                      + "d4=" + distance[4] + "&"
                                                      + "d5=" + distance[5] + "&"
                                                      + "d6=" + distance[6] + "&"
                                                      + "d7=" + distance[7] + "&"
                                                      + "d8=" + distance[8] + "&"
                                                      + "d9=" + distance[9] + "&"
                                                      + "d10=" + distance[10] + "&"
                                                      + "d11=" + distance[11] + "&"
                                                      + "d12=" + distance[12] + "&"
                                                      + "d13=" + distance[13] + "&"
                                                      + "d14=" + distance[14] + "&"
                                                      + "d15=" + distance[15] + "&"
                                                      + "d16=" + distance[16] + "&"
                                                      + "d17=" + distance[17] + "&"
                                                      + "d18=" + distance[18] + "&"
                                                      + "d19=" + distance[19] + "&"
                                                      + "d20=" + distance[20] + "&";
}