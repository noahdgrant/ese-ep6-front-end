<!DOCTYPE html>
<html lang="en">
    <?php $title = "Wyatt's Logbook"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <h1>Wyatt's Weekly Log Book</h1>
                <figure id="photo_of_wyatt">
                    <img src="images/wyatt.jpg" alt=“picture_of_wyatt” title=“wyatt”/>
                    <figcaption>Wyatt</figcaption>
                </figure>
                <br>
                <h2>About me:</h2>
                <p>I am <span id="age"></span> years old.</p>

                <h2>Weekly Logs:</h2>
                <ul>
                    <li><a href="#week1">Week 1: May 6th - May 10th</a></li>
                    <li><a href="#week2">Week 2: May 13th - May 17th</a></li>
                    <li><a href="#week3">Week 3: May 20th - May 24th</a></li>
                    <li><a href="#week4">Week 4: May 27th - May 31st</a></li>
                    <li><a href="#week5">Week 5: June 3th - June 7th</a></li>
                    <li><a href="#week6">Week 6: June 10th - June 14th</a></li>
                    <li><a href="#week7">Week 7: June 17th - June 21th</a></li>
                    <li><a href="#week8">Week 8: June 24th - June 28th</a></li>
                    <li><a href="#week9">Week 9: July 1st - July 5th</a></li>
                    <li><a href="#week10">Week 10: July 8th - July 12th</a></li>
                    <li><a href="#week11">Week 11: July 15th - July 19th</a></li>
                    <li><a href="#week12">Week 12: July 22nd - July 26th</a></li>
                    <li><a href="#week13">Week 13: July 29th - August 2nd</a></li>
                    <li><a href="#week14">Week 14: August 5th - August 9th</a></li>
                    <li><a href="#week15">Week 15: August 12th - August 16th</a></li>
                </ul>

                <h2 id="week1">Week 1</h2>
                <ul>
                    <li>Setup intial front end for server</li>
                    <li>Created Draw.io page for GUI layout</li>
                </ul>
                <h2 id="week2">Week 2</h2>
                <ul>
                    <li>Continued front end development for server</li>
                    <ul>
                        <li>Added assignments, login, and request_access pages </li>
                        <li>Started GUI implementation</li>
                    </ul>
                    <li>Created Draw.io page for FSM</li>
                    <li>Started Working on NFC reader</li>
                    <li>Started assembly of 4 nucleo shields</li>
                </ul>
                <h2 id="week3">Week 3</h2>
                <ul>
                    <li>Continued front end development for server</li>
                    <ul>
                        <li>Started Working on CSS and Bootstrap</li>
                    </ul>
                    <li>Started Working on implementation of NFC sensor with arduino</li>
                    <li>Continued assembling nucleo shields</li>
                </ul>
                <h2 id="week4">Week 4</h2>
                <ul>
                    <li>Continued front end development for server</li>
                    <ul>
                        <li>Created Test Plans & Test plan page</li>
                    </ul>
                    <li>Finished assembling & testing nucleo shields</li>
                    <li>Finished draw.io FSM</li>
                </ul>
                <h2 id="week5">Week 5</h2>
                <ul>
                    <li>Continued front end development for server</li>
                    <ul>
                        <li>Continued Implementing CSS and javascript</li>
                        <li>Added form validation</li>
                        <li>Started Working on arduino NFC & socket code</li>
                    </ul>
                </ul>

                <h2 id="week6">Week 6</h2>
                <ul>
                    <li>Continued front end development for server</li>
                    <ul>
                        <li>Continued Implementing CSS and javascript</li>
                        <li>Added form validation to login page</li>
                        <li>Added additional info field to request access page</li>
                    </ul>
                    <li>Finished first version of NFC socket code</li>
                </ul>
                <h2 id="week7">Week 7</h2>
                <h2 id="week8">Week 8</h2>
                <ul>
                    <li>Reading Week</li>
                </ul>
                <h2 id="week9">Week 9</h2>
                <h2 id="week10">Week 10</h2>
                <h2 id="week11">Week 11</h2>
                <h2 id="week12">Week 12</h2>
                <h2 id="week13">Week 13</h2>
                <h2 id="week14">Week 14</h2>
                <h2 id="week15">Week 15</h2>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>