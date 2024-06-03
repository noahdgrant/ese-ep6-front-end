<!DOCTYPE html>
<html lang="en">
    <?php $title = "Project Plan"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <div>
                    <p>
                        We decided to use GitHub projects to manage our project this semester.
                        We think this is a better solution than creating a Word or Excel document
                        because the GitHub project is easier to keep up to date and keep the information
                        pertaining to the project close to where it is needed.
                    </p>
                    <a href="https://github.com/users/noahdgrant/projects/3">GitHub Project</a>
                </div>
                <iframe frameborder="0" style="width:100%;height:563px;" src="https://viewer.diagrams.net/?tags=%7B%7D&highlight=0000ff&edit=_blank&layers=1&nav=1&title=FSM.drawio#Uhttps%3A%2F%2Fraw.githubusercontent.com%2Fnoahdgrant%2Fese-ep6-front-end%2Fmain%2Fdocuments%2FFSM.drawio"></iframe>
                <iframe frameborder="0" style="width:100%;height:463px;" src="https://viewer.diagrams.net/?tags=%7B%7D&highlight=0000ff&edit=_blank&layers=1&nav=1&title=GUI.drawio#Uhttps%3A%2F%2Fraw.githubusercontent.com%2Fnoahdgrant%2Fese-ep6-front-end%2Fmain%2Fdocuments%2FGUI.drawio"></iframe>
                <div>
                    <a href="./test_plans.php">testing plans</a>
                </div>
                <div>
                    <h2>References:</h2>
                    <a href="./documents/Elevator System - Diagram and Shared CAN Protocol.pdf" target="_blank">CAN Reference</a>
                    <a href="./documents/PCBPrints.PDF" target="_blank">Nucleo Shield PCB</a>
                </div>  
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
