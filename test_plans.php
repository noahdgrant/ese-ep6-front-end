<!DOCTYPE html>
<html lang="en">
    <?php $title = "TODO"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <h1>Test Plans</h1>
                <h4>PCBA testing:</h4>
                <ul>
                    <li>check continuity off all nets, and ensure no nets are shorted</li>
                    <li>inspect all components to ensure they are properly seated</li>
                </ul>
                <h4>PCBA, Nucleo, and CAN testing:</h4>
                <div>
                    <p>
                        There are two sets of LEDs on the STM32 breakout boards for the floor and car controllers. One set of LEDs is to indicate the elevator's current floor, and the other set is to indicate what floor buttons have been pressed.<br>
                        <br>
                        Test firmware process:
                        <br>
                        On boot, turn on both floor 1 LEDs<br>
                        When the floor 1 button is pressed, turn off floor 1 LEDs and turn on floor 2 LEDs<br>
                        When the floor 2 button is pressed, turn off floor 2 LEDs and turn on floor 3 LEDs<br>
                        When the floor 3 button is pressed, turn off floor 3 LEDs and turn on floor 1 LEDs<br>
                        The above cycle then continues as you keep cycling the button presses. This will test that the GPIOs for the buttons and LEDs are configured correctly.<br>
                        <br>
                        In order to also test that the CAN bus is configured correctly and to be able to test multiple STMs simultaneously, we will have the STM broadcast on the CAN network that the button was pressed. Then, any other STMs running the test firmware will change their LED states accordingly.<br>
                        <br>
                        The CAN commands for the test firmware from the STM32s will be the same as when they are running the normal firmware, except that the 7th bit in the data will be set. This way, the supervisory controller will know not to pass on the command to the elevator controller.<br>
                        <br>
                        The main firmware commands are the following:<br>
                        GO_TO_FLOOR_1 = 0000 0101 = 0x5<br>
                        GO_TO_FLOOR_2 = 0000 0110 = 0x6<br>
                        GO_TO_FLOOR_3 = 0000 0111 = 0x7<br>
                        <br>
                        The new commands will be the following:<br>
                        TEST_FLOOR_1 = 1000 0101 = 0x85<br>
                        TEST_FLOOR_2 = 1000 0110 = 0x86<br>
                        TEST_FLOOR_3 = 1000 0111 = 0x87<br>
                    </p>
                </div>
                <h4>Nucleo testing:</h4>
                <ul>
                    <li>Debug logs</li>
                </ul>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
