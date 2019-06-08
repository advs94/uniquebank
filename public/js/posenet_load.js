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
    video.size(640, 500);

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
    image(video, x, y, 640, 500);
    fill(255);
    textSize(16);

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

    let i;

    for (i = 0; i < distance.length; i++)
    {
        if(distance[i] <= (lifedetection[i] * 0.8) || distance[i] >= lifedetection[i] * 1.2)
        {
            // console.log(distance[i]);
            // console.log(lifedetection[i] * 0.9);
            // console.log(lifedetection[i] * 1.1);
            break;
        }
    }

    if(i == 21)
    {
        console.log('You made it!!!!!!');
        // $.post('/authenticate/success', {variable: i});

        // var mysql = require('gulp');

        // var con = mysql.createConnection({
        //     host: "localhost",
        //     user: "root",
        //     password: "",
        //     database: "tutorial"
        // });

        // con.connect(function(err) {
        //     if (err) throw err;
        //     //Update the life_detection_confirmed field:
        //     var sql = "UPDATE user SET life_detection_confirmed = 'true' WHERE id = " + userID;
        //     con.query(sql, function (err, result) {
        //         if (err) throw err;
        //         console.log(result.affectedRows + " record(s) updated");
        //     });
        // });

        window.location.href = 'http://localhost:8000/lifedetection/validation' + '?' + 'email=' + userEmail;
        asd;
    }

    // console.log(distance);
    // console.log(lifedetection);
    // console.log(i);
}
