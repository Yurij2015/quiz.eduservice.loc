<?php

$link = mysql_connect($hostname, $username,$password);

if($link)
{

 	$dbcon = mysql_select_db($dbname,$link);

	if($dbcon)
	{
		
	    	$result = mysql_query("CREATE TABLE hioxpm (username varchar(255) NOT NULL, password varchar(255) default '',  PRIMARY KEY (username))",$link);
		$result1 = @mysql_query("create table quiz(id BIGINT NOT NULL UNIQUE AUTO_INCREMENT, catid varchar(6), question varchar(250),opt1 varchar(100), opt2 varchar(100), opt3 varchar(100),opt4 varchar(100) ,answer varchar(100), datee date, status enum('susbend','release'))",$link); 
               $result2 = @mysql_query("create table category(id BIGINT NOT NULL UNIQUE AUTO_INCREMENT, category varchar(150),status enum('susbend','release'))",$link); 
               $result3 = @mysql_query("create table settings(id BIGINT NOT NULL UNIQUE AUTO_INCREMENT, pagenum varchar(50),examtime varchar(50))",$link);
			     $result3 = @mysql_query("create table quizresults(id BIGINT NOT NULL UNIQUE AUTO_INCREMENT, name varchar(150),cat_id int(20),correct_ans int(20),wrong_ans int(20),marks int(20),datee varchar(20),examtime varchar(50))",$link); 
 @mysql_query("INSERT INTO `settings` (`id`, `pagenum`, `examtime`) VALUES ('1', '1', '00:30:00')");
 
@mysql_query("INSERT INTO `category` (`id`, `category`, `status`) VALUES
(1, 'Sports', 'release'),
(2, 'HTML', 'release'),
(3, 'PHP', 'release'),
(4, 'CSS', 'release')");
@mysql_query("INSERT INTO `quiz` (`id`, `catid`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `datee`, `status`) VALUES
(1, '1', 'Where did India play its 1st one day international match?', 'Lords', 'Headingley', 'Taunton', 'The Oval', '2', '0000-00-00', 'release'),
(2, '1', 'Who was the 1st ODI captain for India?\r\n', 'Ajit Wadekar ', 'Bishen Singh Bedi', 'Nawab Pataudi', 'Vinoo Mankad ', '1', '0000-00-00', 'release'),
(3, '1', 'Who has made the Fastest Test century in Test Cricket ?\r\n\r\n\r\n\r\n', 'Sachin Tendulkar', ' Sahid Afridi', ' Virender Sehwag', 'Vivian Richards', '4', '0000-00-00', 'release'),
(4, '1', 'Which Bowler had the Best figures in a Test Match ?\r\n\r\n\r\n\r\n\r\n', 'Muttiah Muralitharan', 'Bob Massie', 'Jim Laker', 'George Lohmann', '3', '0000-00-00', 'release'),
(5, '1', 'Which team has the Largest successful run chase record in ODIs ?\r\n\r\n\r\n\r\n\r\n', 'England', 'South Africa', 'Australia', 'India', '2', '0000-00-00', 'release'),
(6, '2', 'What does HTML stand for?\r\n\r\n	\r\n	\r\n	', 'Hyper Text Markup Language', 'Hyperlinks and Text Markup Language', 'Home Tool Markup Language', 'Highly Text Markup Language', '1', '0000-00-00', 'release'),
(7, '2', 'Who is making the Web standards?\r\n\r\n	\r\n	\r\n	\r\n	\r\n', 'Microsoft', 'Google', 'The World Wide Web Consortium', 'Mozilla', '3', '0000-00-00', 'release'),
(9, '2', 'What is the HTML element to bold a text?\r\n\r\n\r\n\r\n\r\n', '&lt;b&gt;', '&lt;bold&gt;', '&lt;wide&gt;', '&lt;big&gt;', '1', '0000-00-00', 'release'),
(10, '2', 'What is the HTML tag for a link?\r\n\r\n\r\n\r\n\r\n', '&lt;link&gt;', '&lt;ref&gt;', '&lt;a&gt;', '&lt;hper&gt;', '3', '0000-00-00', 'release'),
(11, '4', 'What does CSS stand for?\r\n\r\n	\r\n	\r\n	\r\n	', 'Creative Style Sheets', 'Colorful Style Sheets', 'Computer Style Sheets', 'Cascading Style Sheets', '4', '0000-00-00', 'release'),
(12, '2', 'Where in an HTML document is the correct place to refer to an external style sheet?\r\n\r\n	\r\n	\r\n	\r\n	', 'In the &lt;body&gt; section ', 'At the end of the document', 'At the top of the document', 'In the &lt;head&gt; section ', '4', '0000-00-00', 'release'),
(13, '2', 'Which HTML tag is used to define an internal style sheet?\r\n\r\n	\r\n	\r\n	', '&lt;script&gt;', '&lt;css&gt;', '&lt;style&gt;', '&lt;link&gt;', '3', '0000-00-00', 'release'),
(14, '4', 'Which is the correct CSS syntax?\r\n\r\n	\r\n	\r\n	\r\n	', 'body:color=black;', '{body;color:black;}', 'body {color: black;}', '{body:color=black;}', '3', '0000-00-00', 'release'),
(15, '4', 'Which property is used to change the background color?\r\n\r\n	\r\n	\r\n	', 'background-color', 'color', 'bgcolor', 'bg-color', '1', '0000-00-00', 'release'),
(16, '3', 'What does PHP stand for?\r\n\r\n	\r\n	\r\n	', ' PHP: Hypertext Preprocessor', 'Personal Hypertext Processor', 'Personal Home Page', 'Private Home Page', '1', '0000-00-00', 'release'),
(17, '3', 'PHP server scripts are surrounded by delimiters, which?\r\n\r\n	\r\n	\r\n	\r\n	', '&lt;?php&gt;...&lt;/?&gt;', '&lt;?php ... ?&gt;', '&lt;script&gt;...&lt;/script&gt;', '&lt;&amp;&gt;...&lt;/&amp;&gt;', '2', '0000-00-00', 'release'),
(18, '3', 'How do you write \"Hello World\" in PHP', '\"Hello World\"', 'echo \"Hello World\"', 'Document.Write(\"Hello World\");', 'print_f(\"Hello World\");', '2', '0000-00-00', 'release')");

		@mysql_free_result($link);
	 	if (!$result)
		{
		    
                   echo(" <div align='center' class='errortext'>
				 <p class='errortext'>Unable to create tables.<br>");
		     echo("Your tables might have already be created.</p>");
		    echo(" <div>");
		    //echo(mysql_error());
		}
		else
		{
		   include "./auth/adminpass.php";
		}
	}
	else
	{
		$vv =false;
	}
}
else
{
	$vv =false;
}


if($vv === false)
{
 echo	"<div class='form' style='margin:25px;border:1px solid #ddd;padding:10px;'>";
 echo "<form method=POST action=$PHP_SELF>";
 echo "<input type=hidden name=type value=changedb>";
 echo "<div class='errortext'>Unable to connect to the database.<br>
	Please check your database entries  </div><br><input type=submit value='dbentries' class='form_button' style='float:left;'><div style='clear:both;'></div>";
 echo "</form>";
echo(" </div>");

}
?>
