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
let bool = false;
let label = 'Raise your left hand for 3 seconds';
let left = 0;
let right = 0;

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
    canvas = createCanvas(660, 520);
    x = (windowWidth - width - 90) / 2;
    y = (windowHeight - height) / 2;
    canvas.position(x, y);
    video = createCapture(VIDEO, videoReady);
    video.size(640, 470);

    poseNet = ml5.poseNet(video, modelReady);
    setTimeout(function() {
        poseNet.on('pose', function (results) 
        {
            bool = false;
            poses = results;
            console.log(poses);

            if(poses.length == 0) 
            {
                window.location.href = 'http://localhost:8000/email'.concat('?noPoses');
                asd;
            }

            if(poses.length > 1 )
            {
                poses.forEach(aux => {
                    // console.log(aux.pose.score);
                    if(aux.pose.score < 0.1)
                    {
                        bool = true;
                    }
                });
    
                if(bool == false)
                {
                    window.location.href = 'http://localhost:8000/email'.concat('?multiplePoses');
                    asd;
                }
            }
            
            gotPoses();
        });
      }, 1000);

    video.hide();
}

function draw()
{
    background(0);
    x = (windowWidth - width - 1240) / 2;
    y = (windowHeight - height - 430) / 2;
    image(video, x, y, 640, 470);
    fill(255);
    textSize(16);
    text(label, 10, height - 15);

    // drawKeypoints();
    // drawSkeleton();
}

// function ok()
// {
//     img = video.get();
//     img.loadPixels();
//     console.log(img.pixels);
// }

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
    // console.log(poses[0].pose.keypoints[9].position.x);
    if(poses[0].pose.keypoints[9].position.y < 470 && left < 66)
    {
        left++;
        console.log(left);

        if(left == 66)
        {
            label = 'Raise your right hand for 3 seconds';
        }
    }
    else if(poses[0].pose.keypoints[9].position.y > 470 && left < 66)
    {
        left = 0;
    }

    if(poses[0].pose.keypoints[10].position.y < 470 && right < 66 && left == 66)
    {
        right++;
        console.log(right);
        
        if(right == 66)
        {
            console.log('You made it!!!!!!');

            window.location.href = 'http://localhost:8000/login' + '?' + 'email=' + userEmail;
            asd;
        }
    }
    else if(poses[0].pose.keypoints[10].position.y > 470 && right < 66 && left == 66)
    {
        right = 0;
    }

    
}
