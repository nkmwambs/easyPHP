<?php
echo Resources::a_href("Training/training", "[View Questions]")." ".Resources::a_href("Training/addlemquestion", "[Add a Question]")." ".Resources::a_href("", "[View Evaluation Results]");
echo "<br><hr><br>";

echo "<button onclick='addlemqstnrow(\"tblqstns\");'>Add Row</button><button onclick='postlemquestion(\"frmlemquestions\");'>Post Questions</button><button id='btnDelRow' style='display:hidden;' onclick='delRow(\"tblqstns\");'>Delete Row</button>";

echo "<form id='frmlemquestions'>";
echo "<table id='tblqstns'>";
echo "<caption>New LEM Questions</caption>";
echo "<tr><th>Check</th><th>Details/ Question</th></tr>";
echo "</table>";
echo "</form>";
?>