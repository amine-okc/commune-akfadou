<?php

 include("../dbconn.php");

 session_start();
 if (!isset($_SESSION['AdminLoginId']))
 {
     header("location: index.php");
 }
 else{

    $table = "news";
    $i = 0;
    $ImageName = "";
    $NewImageName = "";
    while ($i < 20)
    {

            $title = "TEST". $i;
            $author = "Author".$i;
            $content = "Fugiat deserunt pariatur aliqua eiusmod dolor voluptate aliqua qui. Mollit irure nulla in enim. Non deserunt et enim ad quis. Occaecat ipsum dolore incididunt fugiat cillum incididunt ut enim ex. Culpa esse occaecat ut ut proident id amet eiusmod consectetur enim. Dolore ex nulla mollit sunt in excepteur ex est ea aute consequat eiusmod veniam incididunt. Mollit irure ex culpa laboris est veniam duis Lorem nostrud adipisicing ex enim incididunt.

        Officia nostrud qui eiusmod nisi nulla reprehenderit laborum minim mollit amet cillum. Quis nostrud quis elit consequat tempor. Deserunt sint nisi Lorem ut excepteur qui esse ad magna. Mollit aliquip aliqua consectetur est do aliqua. Quis nisi tempor quis esse sint commodo voluptate quis et do veniam excepteur magna exercitation. Ad laborum irure ad aliquip voluptate.

        Non deserunt dolore amet id magna quis labore sit labore esse magna est duis. Sit exercitation ullamco sint eiusmod ea occaecat non. Dolor aliquip consequat adipisicing amet culpa aliqua in culpa aute. Ea nulla deserunt Lorem duis eu nostrud aute proident ut. Amet fugiat officia irure culpa officia tempor.";
            $stat = "achieved";
            $content = str_replace("'", "\'", $content);
            $content = str_replace('"', "\"", $content);
            
            if ($ImageName == '')
                $NewImageName = '';
            if ($table == "news")
                $sql = "INSERT INTO `news` (title, author, content, img) VALUES ('$title', '$author', '$content', '$NewImageName')";
            else if ($table == "projects")
                $sql = "INSERT INTO `projects` (title, content, img, stat) VALUES ('$title', '$content', '$NewImageName', '$stat')";
            else if ($table == "scroll")
                $sql = "INSERT INTO `scroll` (title ,content, img) VALUES ('$title','$content', '$NewImageName')";
            else if ($table == "gallery")
                $sql = "INSERT INTO `gallery` (title, img) VALUES ('$title', '$NewImageName')";
            else if ($table == "com")
                $sql = "INSERT INTO `com` (title, file) VALUES ('$title', '$NewImageName')";
            else if ($table == "appels")
                $sql = "INSERT INTO `appels` (title, content, file) VALUES ('$title', '$content', '$NewImageName')";
            $connection->query($sql);
            $i = $i + 1;

    }
}
?>