<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Assignments"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <h1><a href="./documents/Assignment 1 - Front-End Development.pdf">Assignment 1</a></h1>
                <ol>
                    <h2>HTML</h2>
                    <!-- A1Q1 -->
                    <li><a href="https://github.com/users/noahdgrant/projects/3">GitHub Project</a></li>
                    <!-- A1Q2 -->
                    <li>
                        <ol type="a">
                            <li>What is a branch and how is it different from a master branch?</li>
                            <ul>
                                <li>
                                    A branch is a snapshot in time of the master branch. Branches are sometimes called 'topic branches' and allow someone to work
                                    on the codebase and test their changes independent of other people. Once the programmer is happy with their changes they can
                                    be merged back to the main/master branch so everyone has the changes. The master branch is the source of truth for the codebase
                                    and is what changes are made to.
                                </li>
                            </ul>
                            <li>What is a commit? Are commits made to a branch or to the master? Explain the importance of commit messages.</li>
                            <ul>
                                <li>
                                    A commit is a group of changes what is saved to the repository. Making a commit involves adding changes to the staging area
                                    and writing a commit message. It is best practice to make commits to a topic branch and merge the commits into the master branch
                                    via a pull request. Commit messages are important because they let people know what changed in the commit without having to go
                                    dig through all the code.
                                </li>
                            </ul>
                            <li>What is a pull request? How will pull requests be useful in Project VI?</li>
                            <ul>
                                <li>
                                    A pull request is a request to merge changes from a topic branch into master branch. You make a pull request once you are done
                                    making updates in your topic branch and your changes have been tested. Pull requests will be helpful in Project VI becuase they
                                    will allow us to each work on features independently and then review the changes together before we merge them into the master
                                    branch of the repository.
                                </li>
                            </ul>
                            <li>What happens when you initiate a merge?</li>
                            <ul>
                                <li>
                                    When you initiate a merge you are attemping to add all of the changes from your topic branch onto the main branch. If the same piece
                                    of code has been updated in your topic branch and the main branch you will get a merge conflict that you will have to resolve.
                                </li>
                            </ul>
                            <li>Include a link to your hello-world repository, created in the hello-world activity</li>
                            <ul>
                                <li>We didn't create a hello-world repo because we are both comfortable using git and GitHub and didn't feel is was necessary</li>
                            </ul>
                        </ol>
                    </li>
                    <!-- A1Q3 -->
                    <li>
                        <ul>
                            <li>Local repo:<br><img src="./images/assignments/A1_P1_3_local.png" alt=“picture_of_local_repo” title=local_repo/></li>
                            <li>Remote repo:<br><img src="./images/assignments/A1_P1_3_remote.png" alt=“picture_of_remote_repo” title=remote_repo/></li>
                            <li>Link to <a href ="https://github.com/noahdgrant/ese-ep6-front-end"  target="_blank">remote repo</a></li>
                        </ul>
                    </li>
                    <!-- A1Q4 -->
                    <li><a href="./about.php">About Project VI</a>, <a href="./index.php">Home</a></li>
                    <!-- A1Q5 -->
                    <li>
                        <a href="./project_plan.php">Project Plan</a>,
                        <a href="./logbook_noah.php">Noah's Logbook</a>,
                        <a href="./logbook_wyatt.php">Wyatt's Logbook</a>
                    </li>
                    <!-- A1Q6 -->
                    <li>
                        <ul>
                            <li>Static nav bar is present at the top of all pages</a></li>
                            <li>Link at <a href="#footer">footer</a> of pages returns user back to the top of the page</li>
                        </ul>
                    </li>
                    <!-- A1Q7 -->
                    <li>
                        <ul>
                            <li><a href="./logbook_wyatt.php#photo_of_wyatt">Wyatts Logbook photo</a></li>
                            <li><a href="./logbook_noah.php#photo_of_noah">Noahs Logbook photo</a></li>
                            <li><a href="./about.php#team_photo">Team photo</a></li>
                            <li><a href="./index.php#team_logo">Team logo</a></li>
                        </ul>
                    </li>
                    <!-- A1Q8 -->
                    <li><a href="./gnatt_chart.php">Gantt Chart</a></li>
                    <!-- A1Q9 -->
                    <li><a href="./login.php">Login</a>, <a href="./request_access.php">Request Access</a></li>
                    <!-- A1Q10 -->
                    <li><a href="./about.php#map">Map</a></li>
                    <!-- A1Q11 -->
                    <li>Following tags added to each page:<br><img src="./images/assignments/A1_P1_11.png" alt=“picture_of_header_tags” title=header_tags/></li>
                    <!-- A1Q12 -->
                    <li>Copywrite at <a href="#footer">footer</a> of page</li>
                    <!-- A1Q13 -->
                    <li><a href="./about.php#intro_vid">Intro Video</a></li>
                    <h2>CSS</h2>
                    <!-- A1Q14 -->
                    <li><a href="./project_details.php">Project Details Page</a></li>
                    <!-- A1Q15 -->
                    <li><a href="./css/style.css">CSS Document</a></li>
                    <!-- A1Q16 -->
                    <li><a href="./project_details.php">Project Details Page</a>, <a href="./css/project_details_style.css">CSS Document</a></li>
                    <!-- A1Q17 -->
                    <li><a href="./request_access.php">Request Access Page</a></li>
                    <!-- A1Q18 -->
                    <li><a href="./index.php#login">Request Access Button at Login</a> - <b>Not Done yet</b></li>
                    <!-- A1Q19 -->
                    <li>All pages structured using HTML5 layout elements and 'header, section, footer, aside, nav, article, figure {display: block;}' included in css
                    </li>
                    <!-- A1Q20 -->
                    <li>Bootstrap included in all pages (used for navbar), grid system can be seen used on <a href="./index.php">home</a> page </li>
                    <!-- A1Q21 -->
                    <li>Age included in <a href="./logbook_wyatt.php#age">about section of logbook</a>, year included in <a href = "#footer">footer</a> of all pages</li>
                    <!-- A1Q22 -->
                    <li>Current date and time on <a href="./index.php#current_time">home page</a></li>
                    <!-- A1Q23 -->
                    <li>Form validation on username and password added to <a href="./index.php#current_time">home page</a></li>
                    <!-- A1Q24 -->
                    <li><a href="./index.php">Home page</a> focus on username field on page load</li>
                    <!-- A1Q25 -->
                    <li>Text area in <a href="./request_access.php">request access</a> page has character limit of 180</li>
                    <!-- A1Q26 -->
                    <li>form validation on inputs in <a href="./request_access.php"> requst access</a> page</li>
                </ol>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
