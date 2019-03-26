<?php

include_once 'Connection.php';

class Teacher extends UserData
{
    /**
     * To get list of Teacher fields for user
     * @return array - $arrStrFields
     */
    public function getFields() {
        $arrStrFields = array(',deparment_name',',is_hod',',teaching_subjects');
        return $arrStrFields;
    }
    /**
     * To update All fields
     * @return void
     */
    public function updateFields() {

        $intId             = $_POST['id'];
        $strFirstName      = $_POST['fname'];
        $strLastName       = $_POST['lname'];
        $strEmailId        = $_POST['email'];
        $intPhoneNumber    = $_POST['phone'];
        $strAbout          = $_POST['about'];
        $strUserType       = $_POST['usertype'];
        $strDeparmentName  = $_POST['deparment_name'];
        $strHod            = $_POST['is_hod'];
        $strTeachSubjects  = $_POST['teaching_subjects'];

        $arrStrAllFields = $this->getAllFields();
        $arrStrFields    = $this->getFields();

        $strQueryBuild = "";
        foreach ($arrStrAllFields as $strField) {

            if(isset($_POST[$strField])) {
                $strQueryBuild .= $strField.'= "'.$_POST[$strField].'"';
            }
        }
        foreach ($arrStrFields as $strField) {

            if(isset($_POST[$strField])) {
                $strQueryBuild .= $strField.'= "'.$_POST[$strField].'"';
            }
        }

        $arrSql = "update users SET $strQueryBuild where id = '$intId'";
        $arrObjResult = mysqli_query($this->objConnection, $arrSql);
        if (!$arrObjResult) {
            die("record not update");
        } else {
            ?>
            <script type = "text/javascript">
                alert('upadate data');
                window.location = "view.php";
            </script>
            <?php
        }
    }
}

