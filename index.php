<?php
include_once("services/BoardService.php");
include_once("services/RoomService.php");
include_once("services/ComponentService.php");
include_once("services/TypeService.php");
include_once("services/ReadingService.php");
include_once("controllers/RelayController.php");
include_once("models/Component.php");

$boardService = new BoardService();
$componentService = new ComponentService();
$readingService = new ReadingService();
$roomService = new RoomService();
$typeService = new TypeService();
?>
<html lang="en">
    <link rel="stylesheet" type="text/css" href="style.css">
    Boards:
    <table>
      <tr><th>ID</th><th>IP</th><th>MAC</th><th>Name</th><th>Description</th><th>Room ID</th><th>Last Update</th></tr>
        <?php
        foreach($boardService->read_all() as $board){
            echo "<tr>";
            echo "<td>".$board->id."</td>";
            echo "<td>".$board->ip."</td>";
            echo "<td>".$board->mac."</td>";
            echo "<td>".$board->name."</td>";
            echo "<td>".$board->description."</td>";
            echo "<td>".$board->room_id."</td>";
            echo "<td>".$board->last_update."</td>";
            echo "<td><form action=\"/api/board/delete.php\" method=\"POST\"
                        target=\"noRedirectHandler\" onsubmit=\"setTimeout(function(){window.location.reload();},10);\">
                        <input type=\"hidden\" name=\"id\" value=\"".$board->id."\"/>                       
                        <input type=\"submit\" name=\"deleteBtn\" value=\"X\"/><br>
                    </form></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    Components:
    <table>
      <tr><th>ID</th><th>Name</th><th>Description</th><th>pin</th><th>Board ID</th><th>Type ID</th><th>Room ID</th><th>Last Update</th><th>State</th></tr>
        <?php
        foreach($componentService->read_all() as $component){
            echo "<tr>";
            echo "<td>".$component->id."</td>";
            echo "<td>".$component->name."</td>";
            echo "<td>".$component->description."</td>";
            echo "<td>".$component->pin."</td>";
            echo "<td>".$component->board_id."</td>";
            echo "<td>".$component->type_id."</td>";
            echo "<td>".$component->room_id."</td>";
            echo "<td>".$component->last_update."</td>";
            echo "<td>".$component->state."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    Rooms:
    <table>
      <tr><th>ID</th><th>Name</th><th>Description</th></tr>
        <?php
        foreach($roomService->read_all() as $room){
            echo "<tr>";
            echo "<td>".$room->id."</td>";
            echo "<td>".$room->name."</td>";
            echo "<td>".$room->description."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    Types:
    <table>
      <tr><th>ID</th><th>Name</th><th>Description</th><th>Is Input</th></tr>
        <?php
        foreach($typeService->read_all() as $type){
            echo "<tr>";
            echo "<td>".$type->id."</td>";
            echo "<td>".$type->name."</td>";
            echo "<td>".$type->description."</td>";
            echo "<td>".$type->is_input."</td>";
            echo "<td><form action=\"/api/type/delete.php\" method=\"POST\"
                        target=\"noRedirectHandler\" onsubmit=\"setTimeout(function(){window.location.reload();},10);\">
                        <input type=\"hidden\" name=\"id\" value=\"".$type->id."\"/>                       
                        <input type=\"submit\" name=\"deleteBtn\" value=\"X\"/><br>
                    </form></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    Readings:
    <table>
      <tr><th>ID</th><th>Component ID</th><th>Reading</th><th>Read Time</th></tr>
        <?php
        foreach($readingService->read_all() as $reading){
            echo "<tr>";
            echo "<td>".$reading->id."</td>";
            echo "<td>".$reading->component_id."</td>";
            echo "<td>".$reading->reading."</td>";
            echo "<td>".$reading->read_time."</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Add new room</h2>
    <form method="post" action="/api/room/create.php" target="noRedirectHandler"
          onsubmit="setTimeout(function(){window.location.reload();},10);">
        Room name: <input type="text" name="name">
        <br><br>
        Description: <input type="text" name="description">
        <br><br>
        <input type="submit" name="submit" value="Create">
    </form>

    <iframe name="noRedirectHandler" width="0" height="0" border="0" style="display: none;"></iframe>
</html>

