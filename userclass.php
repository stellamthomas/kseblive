<?php
class userclass
{
	function login($username,$password)
	{
		$en=md5($password);
		$sql="select lkey,status,utype from login where email='".$username."' and pass='".$en."'"; //taking lkey of the username and password entered in the login page

		$conn=mysql_query($sql);
		$a=0;
		while ($rr=mysql_fetch_array($conn)) //taking query result to $rr
		{
			$a++;
			$b=$rr['lkey']; //assigning value of lkey of user to another variable $b
			$c=$rr['utype'];
			$d=$rr['status'];
		}
		if($a>0)
		{
			if($d==1)
			{
				setcookie("lkey",$b);
				setcookie("logined",1);
				if ($c==0)
				{
					header("location:adminhome.php");
				}
				else if($c==1)
				{
					header("location:customerhome.php");
				}
				else if($c==2)
				{
					header("location:contractorhome.php");
				}
				else if($c==3)
				{
					header("location:agencyhome.php");
				}
				else if($c==4)
				{
					header("location:companyhome.php");
				}
				else if($c==5)
				{
					header("location:staffhome.php");
				}
				else
				{
					header("location:teamhome.php");
				}
			}
			else
			{
				echo"<script>alert('Approval Pending.....!!')</script>";
			}
		}
		else
		{
			echo"<script>alert('Invalid User')</script>";
		}
	}
	function teaminsert($a,$b,$c,$d,$e,$kk)
	{
		$teamkey=uniquekey("teamreg","teamkey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name

		$e=md5($e);
		$sql2="insert into login(lkey,email,pass,status,utype)values('".$lkey."','".$d."','".$e."','1','6')";
		$conn2=mysql_query($sql2);

		$id=keytoid("login","lkey",$kk);
		$sql1="insert into teamreg(teamkey,tname,tlname,ttlnmbr,loginid,temail)values('".$teamkey."','".$a."','".$b."','".$c."','".$id."','".$d."')";

		$conn1=mysql_query($sql1);

		if($conn1 AND $conn2)
			echo"<script>alert('Team Registration Successful')</script>";
		else
			echo"<script>alert('Team Registration Failed')</script>";
	}

	function staffinsert($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$s,$comkey)
	{
		$staffkey=uniquekey("staffreg","staffkey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name
		$pass=time();
		$pass1=md5($pass);
		$sql2="insert into login(lkey,email,pass,status,utype)values('".$lkey."','".$k."','".$pass1."','1','5')";
		$conn2=mysql_query($sql2);
		$staffid=keytoid("login","lkey",$lkey);
		$id=keytoid("login","lkey",$comkey);
		$sql1="insert into staffreg(staffkey,cname,caddr,cpin,cstate,cdistrict,gender,age,cphno,cemail,ships,desig,staffid,loginid)values('".$staffkey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."','".$i."','".$s."','".$j."','".$staffid."','".$id."')";
		//echo $sql1;exit;
		$conn1=mysql_query($sql1);

		if($conn1 AND $conn2)
			echo"<script>alert('Staff Registration Successful....Your password is $pass')</script>";
		else
			echo"<script>alert('Staff Registration Failed')</script>";
	}





	function agencyinsert($a,$b,$c,$d,$e,$f,$g,$h,$i,$j)
	{
		$ckey=uniquekey("agencyreg","akey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name

		$i=md5($i);
		$sql2="insert into login(lkey,email,pass,utype)values('".$lkey."','".$h."','".$i."','3')";
		$conn2=mysql_query($sql2);
		$id=keytoid("login","lkey",$lkey);
		$sql1="insert into agencyreg(akey,aname,aaddr,apin,astate,adistrict,aphno,aregno,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$id."')";
		$conn1=mysql_query($sql1);

		if($conn1 AND $conn2)
			echo"<script>alert('Agency Registration Successful')</script>";
		else
			echo"<script>alert('Agency Registration Failed')</scsript>";
	}

	function companyinsert($a,$b,$c,$e,$f,$g,$h,$i,$j,$k)
	{
		$ckey=uniquekey("companyreg","ckey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name

		$j=md5($j);
		$sql2="insert into login(lkey,email,pass,utype)values('".$lkey."','".$i."','".$j."','4')";
		$conn2=mysql_query($sql2);
		$id=keytoid("login","lkey",$lkey);
		$sql1="insert into companyreg(ckey,cname,caddr,cpin,cstate,cdistrict,cphno,cregno,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$e."','".$f."','".$g."','".$h."','".$id."')";
		//echo $sql1;exit;
		$conn1=mysql_query($sql1);

		if($conn1 AND $conn2)
			echo"<script>alert('Company Registration Successful')</script>";
		else
			echo"<script>alert('Company Registration Failed')</script>";
	}

	function contractorinsert($a,$b,$c,$d,$e,$f,$g,$file=null,$i,$j,$k)
	{
		$ckey=uniquekey("contractorreg","ckey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name

		$j=md5($j);
		$sql2="insert into login(lkey,email,pass,utype)values('".$lkey."','".$i."','".$j."','2')";
		$conn2=mysql_query($sql2);
		$id=keytoid("login","lkey",$lkey);
		$sql1="insert into contractorreg(ckey,cname,caddr,cpin,cstate,cdistrict,cphno,cregno,cpwd,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$file['name']."','".$id."')";
		//echo $sql1;exit;
		$conn1=mysql_query($sql1);
		$path="uploads/".$ckey;
		if($conn1 AND $conn2)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Contractor Registration Successful')</script>";

		}

		else
			echo"<script>alert('Contractor Registration Failed')</scsript>";
	}

	function customerinsert($a,$b,$c,$d,$e,$f,$g,$h,$i)
	{
		$ckey=uniquekey("customerreg","ckey");//table name +  key name
		$lkey=uniquekey("login","lkey");//table name +  key name

		$h=md5($h);
		$sql2="insert into login(lkey,email,pass,utype)values('".$lkey."','".$g."','".$h."','1')";
		$conn2=mysql_query($sql2);
		$id=keytoid("login","lkey",$lkey);
		$sql1="insert into customerreg(ckey,cname,caddr,cpin,cstate,cdistrict,cphno,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$id."')";

		$conn1=mysql_query($sql1);

		if($conn1 AND $conn2)
			echo"<script>alert('Customer Registration Successful')</script>";
		else
			echo"<script>alert('Customer Registration Failed')</script>";
	}

	function tenderinsert($a,$b,$c,$d,$e,$f)
	{
		$ckey=uniquekey("tenderreg","tkey");//table name +  key name
		$sql1="insert into tenderreg(tkey,tcat,tamt,tapdt,tstdt,tdesc,tcrdt)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."')";
		$conn1=mysql_query($sql1);

		if($conn1)
			echo"<script>alert('Tender Added Successful')</script>";
		else
			echo"<script>alert('Tender Adding Failed')</script>";
	}

	function shipconstructinsert($a,$file=null,$c,$d,$logkey)
	{
		$shcokey=uniquekey("shipconstruct","shcokey");//table name +  key name
		$logid=keytoid("login","lkey",$logkey);
		$sql1="insert into shipconstruct(shcokey,agencyid,constructfile,shipdesc,scrdt,loginid)values('".$shcokey."','".$a."','".$file['name']."','".$c."','".$d."','".$logid."')";

		$conn1=mysql_query($sql1);
		$path="uploads/".$shcokey;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Construction Details Uploaded Successfully')</script>";
		}
		else
			echo"<script>alert('Ship Construction Details Adding Failed')</script>";
	}

	function reportinsert($a,$b,$file=null,$logkey)
	{
		$reportkey=uniquekey("reportreg","reportkey");//table name +  key name
		$logid=keytoid("login","lkey",$logkey);
		$sql1="insert into reportreg(reportkey,tname,report,crdate,loginid,status)values('".$reportkey."','".$a."','".$file['name']."','".$b."','".$logid."','0')";
	//echo $sql1;exit;
		$conn1=mysql_query($sql1);
		$path="uploads/".$reportkey;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Report Uploaded Successfully')</script>";
		}
		else
			echo"<script>alert('Report Adding Failed')</script>";
	}

	/*
	function selectstaffregcompany($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from staffreg where staffid='".$id."'";

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['loginid'];
		}

		$sql="select * from companyreg inner join login on companyreg.loginid=login.id where loginid='".$ar."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}
	*/

	function designreportinsert($a,$file=null,$kk)
	{
		$reportkey=uniquekey("reportreg","reportkey");//table name +  key name
		$logid=keytoid("agencyreg","akey",$kk);
		$sql="select * from agencyreg where id='".$logid."'";

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['loginid'];
		}

		$sql1="insert into reportreg(reportkey,tname,report,crdate,loginid,status)values('".$reportkey."','development','".$file['name']."','".$a."','".$ar."','1')";
	//echo $sql1;exit;
		$conn1=mysql_query($sql1);
		$path="uploads/".$reportkey;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Report Uploaded Successfully')</script>";
		}
		else
			echo"<script>alert('Report Adding Failed')</script>";
	}

	function testingreportinsert($a,$file=null,$kk)
	{
		$reportkey=uniquekey("reportreg","reportkey");//table name +  key name
		$logid=keytoid("agencyreg","akey",$kk);
		$sql="select * from agencyreg where id='".$logid."'";

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['loginid'];
		}

		$sql1="insert into reportreg(reportkey,tname,report,crdate,loginid,status)values('".$reportkey."','development','".$file['name']."','".$a."','".$ar."','2')";
	//echo $sql1;exit;
		$conn1=mysql_query($sql1);
		$path="uploads/".$reportkey;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Report Uploaded Successfully')</script>";
		}
		else
			echo"<script>alert('Report Adding Failed')</script>";
	}

	function finalreportinsert($a,$file=null,$kk)
	{
		$reportkey=uniquekey("reportreg","reportkey");//table name +  key name
		$logid=keytoid("agencyreg","akey",$kk);
		$sql="select * from agencyreg where id='".$logid."'";

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['loginid'];
		}

		$sql1="insert into reportreg(reportkey,tname,report,crdate,loginid,status)values('".$reportkey."','development','".$file['name']."','".$a."','".$ar."','3')";
	//echo $sql1;exit;
		$conn1=mysql_query($sql1);
		$path="uploads/".$reportkey;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Report Uploaded Successfully')</script>";
		}
		else
			echo"<script>alert('Report Adding Failed')</script>";
	}

	function exportinsert($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$ckey1)
	{
		$ckey=uniquekey("exportreg","exkey");//table name +  key name
		$logid=keytoid("login","lkey",$ckey1);
		//echo $logid;exit;
		$l=date('Y-m-d');
		$trackid=time();
		$sql1="insert into exportreg(exkey,ccat,cscat,cqty,cship,csfrom,csto,cdt,crname,craddr,crph,cremail,crdt,trackid,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."','".$i."','".$j."','".$k."','".$l."','".$trackid."','".$logid."')";
		$conn1=mysql_query($sql1);
		if($conn1)
		{
			header("location:payments.php?qty={$c}&&subcat={$b}");
			echo"<script>alert('Export Details Added Successful your tracking id is : $trackid')</script>";
		}
		else
			echo"<script>alert('Export Details Adding Failed')</script>";
	}

	function updatecallletter($a=null,$kk)
	{
		$id=keytoid("applyjobpost","ajkey",$kk);
		$sql ="update applyjobpost set callletter = '".$a['name']."' where id='".$id."'";
		$conn1=mysql_query($sql);
		$path="uploads/".$kk;
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($a["tmp_name"],$path."/".$a["name"]);
			echo"<script>alert('Call Letter Uploaded Successful')</script>";
		}
		else
			echo"<script>alert('Call Letter Uploading Failed')</script>";
	}

	function refundreg($d,$file=null,$f,$g,$h,$i,$kk)
	{
		$rfkey=uniquekey("refundreg","rfkey");//table name +  key name
		$kk=keytoid("login","lkey",$kk);
		$crdate=date('Y-m-d');
		$sql1="insert into refundreg(rfkey,cqty,crfndimage,cdetails,cbankname,cacno,cifsc,ccrdt,loginid)values('".$rfkey."','".$d."','".$file['name']."','".$f."','".$g."','".$h."','".$i."','".$crdate."','".$kk."')";
		//echo $sql1;exit;
		$path="uploads/".$rfkey;
		$conn1=mysql_query($sql1);
		if($conn1)
		{
			mkdir($path);
			move_uploaded_file($file["tmp_name"],$path."/".$file["name"]);
			echo"<script>alert('Refund Details Uploaded Successfuly')</script>";
		}
		else
			echo"<script>alert('Refund Details Adding Failed')</script>";
	}

	function cardinsert($a,$c,$d,$e,$f,$g)
	{
		$ckey=uniquekey("carddetails","cardkey");//table name +  key name
		$sql1="insert into carddetails(cardkey,crno,crcvv,crmm,cryyyy,crnmeoncard,crcrdt)values('".$ckey."','".$a."','".$c."','".$d."','".$e."','".$f."','".$g."')";
		$conn1=mysql_query($sql1);

		if($conn1)
		{
			$qty=$_GET['qty'];
			$subcat=$_GET['subcat'];

			$sql="select catamt from catadd where subcatname='".$subcat."' ";
			$conn=mysql_query($sql);
			$amt=null;
			while($ret=mysql_fetch_array($conn))
			{
				$amt=$ret['catamt'];
			}
			$bal=$amt*$qty;

			$sql="select bktotalamt from bankac where bkcdno='".$a."' ";
			$conn=mysql_query($sql);
			$ttlamt=null;
			while($ret=mysql_fetch_array($conn))
			{
				$ttlamt=$ret['bktotalamt'];
			}
			$ttlamt=$ttlamt-$bal;
			$sql ="update bankac set bktotalamt = '".$ttlamt."' where bkcdno='".$a."' and bknmeoncard='".$f."'";

			$conn=mysql_query($sql);
			if($conn)
			{
				echo '<script type="text/javascript">';
				echo 'alert("Payment Successful");';
				echo 'window.location.href="exportreg.php"';
				echo '</script>';
			}
			else
				echo"<script>alert('Payment Not Successfull...!!')</script>";
		}
		else
			echo"<script>alert('Card Details Adding Failed')</script>";
	}

	function refundamount($a,$c,$d,$e,$f,$g,$h,$i)
	{
		$sql1="select bktotalamt,cvv from bankac where bkacno='".$e."'";
		$conn=mysql_query($sql1);
		$totalamt=null;
		$cvv=null;
		while($ret=mysql_fetch_array($conn))
		{
			$totalamt=$ret['bktotalamt'];
			//$cvv=$ret['cvv'];
		}
		//echo $totalamt;exit;
		if($totalamt==null)
		{
			echo"<script>alert('Enter Correct Account Details')</script>";
		}
		else
		{
			$totalamt=$totalamt-$f;
			$sql1="update bankac set bktotalamt='".$totalamt."' where bkacno='".$e."'";
			$conn=mysql_query($sql1);

			$sql1="select bktotalamt from bankac where bkacno='".$i."'";
			//echo $sql1;exit;
			$conn1=mysql_query($sql1);
			$totalamt=null;
			while($ret=mysql_fetch_array($conn1))
			{
				$totalamt=$ret['bktotalamt'];
			}
			$sql1="select bktotalamt from bankac where bkacno='".$i."'";
			$conn=mysql_query($sql1);
			$totalamt=null;
			while($ret=mysql_fetch_array($conn))
			{
				$totalamt=$ret['bktotalamt'];
			}

			$totalamt=$totalamt+$f;
			$sql1="update bankac set bktotalamt='".$totalamt."' where bkacno='".$i."'";
			$conn2=mysql_query($sql1);

			if($conn1 && $conn2)
				echo"<script>alert('Payment Successfull...!!')</script>";
			else
				echo"<script>alert('Payment Not Successfull...!!')</script>";


		}

	}

	function shipinsert($a,$b,$c,$d,$e,$f,$g,$h,$i,$cook)
	{
		$ckey=uniquekey("shipreg","skey");//table name +  key name
		$j=keytoid("login","lkey",$cook);

		$sql1="insert into shipreg(skey,sid,sname,smaxwt,sheight,swidth,sfrom,sto,sstime,srtime,loginid)values('".$ckey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."','".$i."','".$j."')";

		$conn1=mysql_query($sql1);

		if($conn1)
			echo"<script>alert('Ship Added Successful')</script>";
		else
			echo"<script>alert('Ship Adding Failed')</script>";
	}

//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	function complaintinsert($a,$b,$c,$d)
	{
		$cmpkey=uniquekey("complaintreg","cmpkey");//table name +  key name

		$d=keytoid("login","lkey",$d);
		$e=date('y-m-d');
		$sql1="insert into complaintreg(cmpkey,cname,csub,ccmp,usrid,ccrdt)values('".$cmpkey."','".$a."','".$b."','".$c."','".$d."','".$e."')";
		$conn1=mysql_query($sql1);

		if($conn1)
			echo"<script>alert('Complaint Added Successful')</script>";
		else
			echo"<script>alert('Complaint Adding Failed')</script>";
	}

	function msgreplayinsert($a,$b,$c)
	{
		$msgkey=uniquekey("msgreg","msgkey");//table name +  key name
		$sndid=keytoid("login","lkey",$b);
		//$rcvid=keytoid("customerreg","ckey",$c);
		$e=date('Y-m-d');
		$sql1="insert into msgreg(msgkey,sndid,rcvid,msg,msgcrdte)values('".$msgkey."','".$c."','".$sndid."','".$a."','".$e."')";
		//echo $sql1;exit;
		$conn1=mysql_query($sql1);

		if($conn1)
			echo"<script>alert('Message reply Successfully')</script>";
		else
			echo"<script>alert('Message reply sending Failed')</script>";
	}

	function msginsert($a,$b,$c)
	{
		$msgkey=uniquekey("msgreg","msgkey");//table name +  key name
		$sndid=keytoid("login","lkey",$c);
		$sql="select loginid from companyreg where cname='".$a."' ";
		$conn=mysql_query($sql);
		$lgid=null;
		while($ret=mysql_fetch_array($conn))
		{
			$lgid=$ret['loginid'];
		}
		$d=date('y-m-d');
		$sql1="insert into msgreg(msgkey,sndid,rcvid,comname,msg,msgcrdte)values('".$msgkey."','".$sndid."','".$lgid."','".$a."','".$b."','".$d."')";
		$conn1=mysql_query($sql1);
		if($conn1)
			echo"<script>alert('Message send Successfully')</script>";
		else
			echo"<script>alert('Message sending Failed')</script>";
	}


	function updateshipack($a=null,$kk)
	{
		$id=keytoid("shipconstruct","shcokey",$kk);
		$sql ="update shipconstruct set shipack = '".$a['name']."' where id='".$id."'";
		$conn1=mysql_query($sql);
		$path="uploads/".$kk;
		if($conn1)
		{
			move_uploaded_file($a["tmp_name"],$path."/".$a["name"]);
			echo"<script>alert('Image File uploaded Successful')</script>";
		}
		else
			echo"<script>alert('Image File Uploading Failed')</script>";
	}

	function updaterefundreg($f,$g,$h,$i,$kk)
	{
		$id=keytoid("refundreg","rfkey",$kk);
		$da=date('y-m-d');
		$sql ="update refundreg set cdetails='".$f."',cbankname='".$g."',cacno='".$h."',cifsc='".$i."',ccrdt='".$da."' where id='".$id."'";
		//echo $sql;exit;
		$conn1=mysql_query($sql);
		if($conn1)
		{
			echo"<script>alert('Exportreg File uploaded Successful')</script>";
		}
		else
			echo"<script>alert('Exportreg File Uploading Failed')</script>";
	}


	function applytenderinsert($a,$b,$c,$d)
	{
		$ckey=uniquekey("applytender","atkey");//table name +  key name

		$tid=keytoid("tenderreg","tkey",$b);
		$cid=keytoid("login","lkey",$a);

		$sql1="insert into applytender(atkey,attid,atcid,atcrdt,amt)values('".$ckey."','".$tid."','".$cid."','".$c."','".$d."')";

		$conn1=mysql_query($sql1);

		if($conn1){
			echo '<script type="text/javascript">';
			echo 'alert("Apply Tender Successful");';
			echo 'window.location.href="viewtendercontractor.php"';
			echo '</script>';
		}
		else
			echo"<script>alert('Apply Tender Failed')</script>";
	}

	function applyjobpostinsert($a,$b,$c)
	{
		$ckey=uniquekey("applyjobpost","ajkey");//table name +  key name

		$tid=keytoid("jobpost","jkey",$b);
		$cid=keytoid("login","lkey",$a);

		$sql1="insert into applyjobpost(ajkey,ajjid,ajcid,ajcrdt)values('".$ckey."','".$tid."','".$cid."','".$c."')";

		$conn1=mysql_query($sql1);
		$sql ="update applyjobpost set status = '1' where ajcid='".$cid."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		if($conn1 && $conn){
			echo '<script type="text/javascript">';
			echo 'alert("Apply Job Successful");';
			echo 'window.location.href="viewjobpost4customer.php"';
			echo '</script>';
		}

		else
			echo"<script>alert('Apply Job Failed')</script>";
	}

	function newsinsert($a,$b,$c)
	{
		$nkey=uniquekey("news","nkey");//table name +  key name

		$sql="insert into news(nkey,newstitle,newsdesc,date)values('".$nkey."','".$a."','".$b."','".$c."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('News Inserted Successfully')</script>";
		else
			echo"<script>alert('News Insertion Failed')</script>";
	}

	function mailinsert($a,$b,$c,$d,$e,$f)
	{
		$nkey=uniquekey("mailinsert","mailkey");//table name +  key name

		$sql="insert into mailinsert(mailkey,name,sub,email,phno,msg,crdate)values('".$nkey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Message Send Successfully')</script>";
		else
			echo"<script>alert('Message Sending Failed')</script>";
	}

	function jobpostinsert($a,$b,$c,$d,$e,$f)
	{
		$nkey=uniquekey("jobpost","jkey");//table name +  key name
		$g=date('y-m-d');

		$sql="insert into jobpost(jkey,jtitle,jsalary,jqual,jwork,jdetails,jdate,jcrdate)values('".$nkey."','".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Job Post Inserted Successfully')</script>";
		else
			echo"<script>alert('Job Post Insertion Failed')</script>";
	}


	function categoryinsert($a)
	{
		$nkey=uniquekey("categoryreg","categorykey");//table name +  key name

		$sql="insert into categoryreg(categorykey,catname)values('".$nkey."','".$a."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Category Inserted Successfully')</script>";
		else
			echo"<script>alert('Category Insertion Failed')</script>";
	}

	function cataddinsert($a,$b,$c,$d)
	{
		$nkey=uniquekey("catadd","catkey");//table name +  key name

		$sql="insert into catadd(catkey,catid,subcatname,catamt,cattax)values('".$nkey."','".$a."','".$b."','".$c."','".$d."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Category Inserted Successfully')</script>";
		else
			echo"<script>alert('Category Insertion Failed')</script>";
	}

	function notificationinsert($a,$b)
	{
		$nkey=uniquekey("notify","notkey");//table name +  key name

		$sql="insert into notify(notkey,notification,date)values('".$nkey."','".$a."','".$b."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Notification Inserted Successfully')</script>";
		else
			echo"<script>alert('Notification Insertion Failed')</script>";
	}
	function notificationsinsert($a,$b,$kk)
	{
		$nkey=uniquekey("notify","notkey");//table name +  key name
		$logid=keytoid("login","lkey",$kk);
		$sql="insert into notify(notkey,notification,date,loginid)values('".$nkey."','".$a."','".$b."','".$logid."')";

		$conn1=mysql_query($sql);

		if($conn1)
			echo"<script>alert('Notification Inserted Successfully')</script>";
		else
			echo"<script>alert('Notification Insertion Failed')</script>";
	}

	function selecttrackreg()
	{
		$sql="select * from exportreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}



	function locationcheck($a,$logkey)
	{
		$logid=keytoid("login","lkey",$logkey);
		$sql="select * from tracking join staffreg on staffreg.staffid=tracking.loginid join exportreg on exportreg.cship=staffreg.ships where exportreg.loginid='".$logid."' and exportreg.trackid='".$a."'";
		//echo $sql;exit;
		$conn1=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn1))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function tendernotification($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select status from applytender where atcid='".$id."'";

		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcatreg()
	{
		$sql="select catname from categoryreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}
	function selectsubcatreg()
	{
		$sql="select subcatname from catadd";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}
	function selectshipregi()
	{
		$sql="select sname,sfrom,sto,id from shipreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcompanyreg()
	{
		$sql="select * from companyreg inner join login on login.id=companyreg.loginid";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selecttendercontractorapply($a)
	{
		$idi=keytoid("login","lkey",$a);
		$sql="select * from applytender join tenderreg on tenderreg.id=applytender.attid join contractorreg on contractorreg.loginid=applytender.atcid where loginid='".$idi."'";

		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectcustomerreg()
	{
		$sql="select * from customerreg inner join login on login.id=customerreg.loginid";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectstates()
	{
		$sql="select * from state";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcustomerregnew($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from customerreg inner join login on login.id=customerreg.loginid where loginid='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectrefundregcompany($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from refundreg inner join shipreg on shipreg.id=refundreg.cship inner join companyreg on companyreg.loginid=shipreg.loginid where companyreg.loginid='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectcontractorregnew($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from contractorreg inner join login on login.id=contractorreg.loginid where loginid='".$idi."'";

		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function updatecontractorregnew($a,$b,$c,$d,$e,$f,$g,$h,$ckey)
	{
		$id=keytoid("login","lkey",$ckey);
		$sql1="update contractorreg set cname='".$a."',caddr='".$b."',cpin='".$c."',cstate='".$d."',cdistrict='".$e."',cphno='".$f."',cregno='".$h."' where loginid='".$id."'";
		$sql2="update login set email='".$g."' where id='".$id."'";
		$conn1=mysql_query($sql1);
		$conn2=mysql_query($sql2);
		if($conn1 && $conn2)
			echo"<script>alert('Profile Updation Successful')</script>";
		else
			echo"<script>alert('Profile Updation not succeful')</script>";
	}

	function trackinginsert($a,$ckey)
	{
		$logid=keytoid("exportreg","exkey",$ckey);
		$b=date('Y-m-d');
		date_default_timezone_set('Asia/Kolkata');
		$c=date('h:i:s');

		$sql="update exportreg set location='".$a."',date='".$b."',time='".$c."' where id='".$logid."'";
		//echo $sql;exit;
		$conn1=mysql_query($sql);

		if($conn1)
			{
				echo '<script type="text/javascript">';
				echo 'alert("Tracking location updation Successfully");';
				echo 'window.location.href="viewtrackreg.php"';
				echo '</script>';
			}
		else
			echo"<script>alert('Tracking location updation Failed')</script>";
	}

	function selecttracking($kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql="select * from exportreg where loginid='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectstaffregcompany($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from staffreg where staffid='".$id."'";

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['loginid'];
		}

		$sql="select * from companyreg inner join login on companyreg.loginid=login.id where loginid='".$ar."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	/*function selectagencyname($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from agencyreg where loginid='".$id."'";
		echo $sql;exit;

		$conn=mysql_query($sql);
		$ar=0;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['aname'];
		}
		echo $ar;exit;
		/*$sql="select * from companyreg inner join login on companyreg.loginid=login.id where loginid='".$ar."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		//return $ar;
	}*/


	function selectcompanystaffs($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from staffreg inner join login on staffreg.loginid=login.id where loginid='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selecttendernotify($ckey)
	{
		$sql="select * from applytender";
		$conn=mysql_query($sql);
		$ar=null;
		while($ret=mysql_fetch_array($conn))
		{
			$ar=$ret['status'];
		}
		return $ar;
	}

	function selectcompany()
	{
		$sql="select cname from companyreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectnews()
	{
		$sql="select * from news ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcategory()
	{
		$sql="select * from categoryreg ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectjobpost()
	{
		$sql="select * from jobpost ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectstatus($kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql="select status from applyjobpost where ajcid='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectstaffreg($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from staffreg where staffid='".$idi."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcontractorreg()
	{
		$sql="select * from contractorreg inner join login on login.id=contractorreg.loginid";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$a="uploads/".$ret['ckey']."/".$ret['cpwd'];
			$ret['cpwd']=$a;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcomplaintreg()
	{
		$sql="select * from complaintreg ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectmsgreg()
	{
		$sql="select * from msgreg ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectadminmsgreg($a)
	{
		$idi=keytoid("login","lkey",$a);
		$sql="select * from msgreg inner join customerreg on customerreg.loginid=msgreg.sndid where rcvid='".$idi."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectexportreg()
	{
		$sql="select * from exportreg ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectrefundreg()
	{
		$sql="select * from refundreg ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['rfkey']."/".$ret['crfndimage'];
			$ret['paths']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selecttenderreg()
	{
		$sql="select * from tenderreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectshipreg($cook)
	{
		$idi=keytoid("login","lkey",$cook);
		$sql="select * from shipreg where loginid='".$idi."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function adminselecttenderreg()
	{
		$sql="select * from tenderreg order by id desc";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectagencyreg()
	{
		$sql="select * from agencyreg inner join login on login.id=agencyreg.loginid";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectagencyprofile($a)
	{
		$id=keytoid("login","lkey",$a);
		$sql="select * from agencyreg inner join login on agencyreg.loginid=login.id where loginid='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcompanyprofile($ckey)
	{
		$id=keytoid("login","lkey",$ckey);
		$sql="select * from companyreg inner join login on companyreg.loginid=login.id where loginid='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectaddcat()
	{
		$sql="select * from catadd inner join categoryreg on categoryreg.id=catadd.catid";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectnotify()
	{
		$sql="select * from notify";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}
	function selectnotifyc($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from notify where loginid='".$idi."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectteamreg()
	{
		$sql="select * from teamreg";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}



	function selectshipconstruct($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from agencyreg inner join shipconstruct on shipconstruct.agencyid=agencyreg.loginid where shipconstruct.agencyid='".$idi."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['shcokey']."/".$ret['constructfile'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectreportreg($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from reportreg  where loginid='".$idi."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['reportkey']."/".$ret['report'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectdesignteamreports($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from reportreg inner join agencyreg on reportreg.loginid=agencyreg.loginid and status='0'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['reportkey']."/".$ret['report'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}
	function selectdevelopmentteamreports($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from reportreg inner join agencyreg on reportreg.loginid=agencyreg.loginid and status='1'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['reportkey']."/".$ret['report'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selecttestingteamreports($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from reportreg inner join agencyreg on reportreg.loginid=agencyreg.loginid and status='2'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['reportkey']."/".$ret['report'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectfinalreports($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from reportreg inner join agencyreg on reportreg.loginid=agencyreg.loginid and status='3'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['reportkey']."/".$ret['report'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectcompanyshipconstruct($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from agencyreg inner join shipconstruct on shipconstruct.agencyid=agencyreg.loginid where shipconstruct.loginid='".$idi."'";
		$conn=mysql_query($sql);
		//echo $sql;exit;
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['shcokey']."/".$ret['constructfile'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectagencyshipconstruct($kk)
	{
		$idi=keytoid("login","lkey",$kk);
		$sql="select * from shipconstruct inner join agencyreg on agencyreg.loginid=shipconstruct.agencyid where shipconstruct.loginid='".$idi."'";
		$conn=mysql_query($sql);
		//echo $sql;exit;
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['shcokey']."/".$ret['constructfile'];
			$ret['path']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}

	function viewapplytender()
	{
		$sql="select * from applytender join tenderreg on tenderreg.id=applytender.attid join contractorreg on contractorreg.loginid=applytender.atcid ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function viewapplytendernotify($kk)
	{
		$sql="select * from applytender join tenderreg on tenderreg.id=applytender.attid join contractorreg on contractorreg.loginid=applytender.atcid ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function viewapplyjobpost()
	{
		$sql="select * from applyjobpost join jobpost on jobpost.id=applyjobpost.ajjid join customerreg on customerreg.loginid=applyjobpost.ajcid ";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}
//===-=0=-0-0--=0000--00-0-0-0=0-00-0-0-00000=-
	function selectcallletter($kk)
	{
	//	echo $kk;exit;
		$idi=keytoid("login","lkey",$kk);
		$sql="select callletter,ajkey from applyjobpost  where ajcid='".$idi."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$path="uploads/".$ret['ajkey']."/".$ret['callletter'];
			$ret['paths']=$path;
			$ar[]=$ret;
		}
		return $ar;
	}
//===-=0=-0-0--=0000--00-0-0-0=0-00-0-0-00000=-
//----------------------------------------------------------------
	function approvecompanyreg($kk)
	{
		$id=keytoid("companyreg","ckey",$kk);


		$uu="select loginid from companyreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}

		$sql ="update login set status = '1' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcompanyreg.php");
		else
			echo"<script>alert('Company Registration Not Approved')</script>";
	}

	function approveagencyreg($kk)
	{
		$id=keytoid("agencyreg","akey",$kk);

		$uu="select loginid from agencyreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}

		$sql ="update login set status = '1' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewagencyreg.php");
		else
			echo"<script>alert('Agency Registration Not Approved')</script>";
	}


	function approvecontractorreg($kk)
	{
		$id=keytoid("contractorreg","ckey",$kk);


		$uu="select loginid from contractorreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}


		$sql ="update login set status = '1' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcontractorreg.php");
		else
			echo"<script>alert('Contractor Registration Not Approved')</script>";
	}

	function approveapplytender($kk)
	{
		$id=keytoid("applytender","atkey",$kk);


		$sql ="update applytender set status = '1' where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewapplytender.php");
		else
			echo"<script>alert('Tender Apply Request Approved')</script>";
	}
//------------------------------------------------------------------------------------

	function rejectagencyreg($kk)
	{
		$id=keytoid("agencyreg","akey",$kk);

		$uu="select loginid from agencyreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}

		$sql ="update login set status = '2' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewagencyreg.php");
		else
			echo"<script>alert('Agency Registration Not Rejected')</script>";
	}

	function rejectapplytender($kk)
	{
		$id=keytoid("applytender","atkey",$kk);


		$sql ="update applytender set status = '2' where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewapplytender.php");
		else
			echo"<script>alert('Tender Apply Request Rejected')</script>";
	}

	function rejectcompanyreg($kk)
	{
		$id=keytoid("companyreg","ckey",$kk);

		$uu="select loginid from companyreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}

		$sql ="update login set status = '2' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcompanyreg.php");
		else
			echo"<script>alert('Company Registration Not Rejected')</script>";
	}


	function rejectcontractorreg($kk)
	{
		$id=keytoid("contractorreg","ckey",$kk);

		$uu="select loginid from contractorreg where id='".$id."'";
		$exe=mysql_query($uu);
		while ($rr=mysql_fetch_array($exe)) {
			# code...
			$idi=$rr['loginid'];
		}

		$sql ="update login set status = '2' where id='".$idi."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcontractorreg.php");
		else
			echo"<script>alert('Contractor Registration Not Rejected')</script>";
	}

//----------------------------------------------------------------------------

	function deletetenderreg($kk)
	{
		$id=keytoid("tenderreg","tkey",$kk);
		$sql="delete from tenderreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewtenderreg.php");
		else
			echo"<script>alert('Tender Not Deleted')</script>";
	}

	function deleterefundreg($kk)
	{
		$id=keytoid("refundreg","rfkey",$kk);
		$sql="delete from refundreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewrefundreg.php");
		else
			echo"<script>alert('Refund Details Not Deleted')</script>";
	}

	function deleteteamreg($kk)
	{
		$id=keytoid("teamreg","teamkey",$kk);
		$sql="delete from teamreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewteamreg.php");
		else
			echo"<script>alert('Team Not Deleted')</script>";
	}

	function deleteexportreg($kk)
	{
		$id=keytoid("exportreg","exkey",$kk);
		$sql="delete from exportreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewexportreg.php");
		else
			echo"<script>alert('Export Details Not Deleted')</script>";
	}

	function deleteaddcat($kk)
	{
		$id=keytoid("catadd","catkey",$kk);
		$sql="delete from catadd where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewaddcat.php");
		else
			echo"<script>alert('Category Not Deleted')</script>";
	}

	function deletecategoryreg($kk)
	{
		$id=keytoid("categoryreg","categorykey",$kk);
		$sql="delete from categoryreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcategoryreg.php");
		else
			echo"<script>alert('Category Not Deleted')</script>";
	}

	function deletecomplaintreg($kk)
	{
		$id=keytoid("complaintreg","cmpkey",$kk);
		$sql="delete from complaintreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcomplaintreg.php");
		else
			echo"<script>alert('Complaint Not Deleted')</script>";
	}

	function deleteshipconstruct($kk)
	{
		$id=keytoid("shipconstruct","shcokey",$kk);
		$sql="delete from shipconstruct where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewshipconstruct.php");
		else
			echo"<script>alert('Ship Construction Details Not Deleted')</script>";
	}

	function deletereportreg($kk)
	{
		$id=keytoid("reportreg","reportkey",$kk);
		$sql="delete from reportreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewreportreg.php");
		else
			echo"<script>alert('Report Not Deleted')</script>";
	}

	function deletemsgreg($kk)
	{
		$id=keytoid("msgreg","msgkey",$kk);
		$sql="delete from msgreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewmsgreg.php");
		else
			echo"<script>alert('Message Deleted')</script>";
	}


	function deleteshipreg($kk)
	{
		$id=keytoid("shipreg","skey",$kk);
		$sql="delete from shipreg where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewshipreg.php");
		else
			echo"<script>alert('Ship Not Deleted')</script>";
	}



	function deletejobpost($kk)
	{
		$id=keytoid("jobpost","jkey",$kk);
		$sql="delete from jobpost where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewjobpost.php");
		else
			echo"<script>alert('Job Post Not Deleted')</script>";
	}

	function deletenews($kk)
	{
		$id=keytoid("news","nkey",$kk);
		$sql="delete from news where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewnews.php");
		else
			echo"<script>alert('News Not Deleted')</script>";
	}

	function deletenotify($kk)
	{
		$id=keytoid("notify","notkey",$kk);
		$sql="delete from notify where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewnotify.php");
		else
			echo"<script>alert('Notification Not Deleted')</script>";
	}
	function deletenotifycom($kk)
	{
		$id=keytoid("notify","notkey",$kk);
		$sql="delete from notify where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewcompanynotify.php");
		else
			echo"<script>alert('Notification Not Deleted')</script>";
	}

	function deletetendercontractorapply($kk)
	{
		$id=keytoid("applytender","atkey",$kk);
		$sql="delete from applytender where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewtendercontractorapply.php");
		else
			echo"<script>alert('Tender apply not cancelled')</script>";
	}

	function deletetracking($kk)
	{
		$id=keytoid("tracking","trackkey",$kk);
		$sql="delete from tracking where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			header("location:viewtrackreg.php");
		else
			echo"<script>alert('Tracking Location Not Deleted')</script>";
	}

	function updatetenderreg($a,$b,$c,$d,$e,$f,$kk)
	{
		$id=keytoid("tenderreg","tkey",$kk);
		$sql="update tenderreg set tkey='".$a."',tcat='".$b."',tamt='".$c."',tapdt='".$d."',tstdt='".$e."',tdesc='".$f."' where id='".$id."'";
		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Updation Successful')</script>";
		else
			echo"<script>alert('Updation not succeful')</script>";
	}

	function updatejobpost($a,$b,$c,$d,$e,$f,$kk)
	{
		$id=keytoid("jobpost","jkey",$kk);
		$g=date('y-m-d');
		$sql="update jobpost set jtitle='".$a."',jsalary='".$b."',jqual='".$c."',jwork='".$d."',jdetails='".$e."',jdate='".$f."',jcrdate='".$g."' where id='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Job Post Updation Successful')</script>";
		else
			echo"<script>alert('Job Post Updation not succeful')</script>";
	}


	function updatecatadd($a,$b,$c,$d,$kk)
	{
		//$a11=keytoid("categoryreg","categorykey",$kk);
		$id=keytoid("catadd","catkey",$kk);
		$sql="update catadd set catid='".$a."',subcatname='".$b."',catamt='".$c."',cattax='".$d."' where id='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Category Updation Successful')</script>";
		else
			echo"<script>alert('Category Updation not succeful')</script>";
	}


	function updateagencyprofile($a,$b,$c,$d,$e,$f,$g,$h,$kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql1="update agencyreg set aname='".$a."',aaddr='".$b."',apin='".$c."',astate='".$d."',adistrict='".$e."',aphno='".$f."',aregno='".$g."' where loginid='".$id."'";
		$conn1=mysql_query($sql1);
		$sql2="update login set email='".$h."' where id='".$id."'";
		$conn2=mysql_query($sql2);

		if($conn1&&$conn2)
			echo"<script>alert('Profile Updation Successful')</script>";
		else
			echo"<script>alert('Profile Updation not succeful')</script>";
	}


	function updatecompanyprofile($a,$b,$c,$d,$e,$f,$g,$h,$kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql1="update companyreg set cname='".$a."',caddr='".$b."',cpin='".$c."',cstate='".$d."',cdistrict='".$e."',cphno='".$f."',cregno='".$g."' where loginid='".$id."'";
		$conn1=mysql_query($sql1);

		$sql2="update login set email='".$h."' where id='".$id."'";
		$conn2=mysql_query($sql2);

		if($conn1&&$conn2)
			echo"<script>alert('Profile Updation Successful')</script>";
		else
			echo"<script>alert('Profile Updation not succeful')</script>";
	}


	function updatecomplaintreg($a,$b,$c,$kk)
	{
		$id=keytoid("complaintreg","cmpkey",$kk);
		$d=date('Y-m-d');
		$sql="update complaintreg set cname='".$a."',csub='".$b."',ccmp='".$c."',ccrdt='".$d."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Complaint Updation Successful')</script>";
		else
			echo"<script>alert('Complaint Updation not succeful')</script>";
	}

	function updateexportreg($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$kk)
	{
		$id=keytoid("exportreg","exkey",$kk);
		$l=date('Y-m-d');
		$sql="update exportreg set ccat='".$a."',cscat='".$b."',cqty='".$c."',cship='".$d."',csfrom='".$e."',csto='".$f."',cdt='".$g."',crname='".$h."',craddr='".$i."',crph='".$j."',cremail='".$k."',crdt='".$l."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Export Reg Updation Successful')</script>";
		else
			echo"<script>alert('Export Reg Updation not successful')</script>";
	}



	function updatecustomerview($a,$b,$c,$d,$e,$f,$g,$kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql1="update customerreg set cname='".$a."',caddr='".$b."',cpin='".$c."',cstate='".$d."',cdistrict='".$e."',cphno='".$f."' where loginid='".$id."'";
		//echo $sql1;
		$sql2="update login set email='".$g."' where id='".$id."'";
		$conn1=mysql_query($sql1);
		$conn2=mysql_query($sql2);
		if($conn1 && $conn2)
			echo"<script>alert('Customer Updation Successful')</script>";
		else
			echo"<script>alert('Customer Updation not successful')</script>";
	}




//#################################################################################

	function updatenews($a,$b,$c,$kk)
	{
		$id=keytoid("news","nkey",$kk);
		$sql="update news set newstitle='".$a."',newsdesc='".$b."',date='".$c."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('News Updation Successful')</script>";
		else
			echo"<script>alert('News Updation not succeful')</script>";
	}

	function updatecategory($a,$kk)
	{
		$id=keytoid("categoryreg","categorykey",$kk);
		$sql="update categoryreg set catname='".$a."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Category Updation Successful')</script>";
		else
			echo"<script>alert('Category Updation not succeful')</script>";
	}

	function updatenotify($a,$b,$kk)
	{
		$id=keytoid("notify","notkey",$kk);
		$sql="update notify set notification='".$a."',date='".$b."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Notification Updation Successful')</script>";
		else
			echo"<script>alert('Notification Updation not succeful')</script>";
	}

	function updateteamreg($a,$b,$c,$d,$kk)
	{
		$id=keytoid("teamreg","teamkey",$kk);
		$sql1="update teamreg set tname='".$a."',ttlnmbr='".$c."',tlname='".$b."',temail='".$d."' where id='".$id."'";
		$conn1=mysql_query($sql1);

		$id=keytoid("login","lkey",$kk);
		$sql2="update login set email='".$d."' where loginid='".$id."'";
		echo $sql2;exit;
		$conn2=mysql_query($sql2);

		if($conn1 && $conn2)
			echo"<script>alert('Team Updation Successful')</script>";
		else
			echo"<script>alert('Team Updation not succeful')</script>";
	}

	function updatetrackreg($a,$b,$c,$kk)
	{
		$id=keytoid("tracking","trackkey",$kk);
		$sql="update tracking set location='".$a."',crdate='".$b."',crtime='".$c."' where id='".$id."'";

		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Location Updation Successful')</script>";
		else
			echo"<script>alert('Location Updation not succeful')</script>";
	}

	function selectuser($kk)
	{
		$id=keytoid("tenderreg","tkey",$kk);
		$sql="select * from tenderreg where id='".$id."'";
		//
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectexportregdetails($kk)
	{
		$id=keytoid("login","lkey",$kk);
		$sql="select * from exportreg where loginid='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selecttrackingview($a)
	{
		$sql="select * from tracking join staffreg on staffreg.staffid=tracking.loginid join exportreg on exportreg.cship=staffreg.ships where trackid='".$a."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectuserfornews($kk)
	{
		$id=keytoid("news","nkey",$kk);
		$sql="select * from news where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectuserjobpost($kk)
	{
		$id=keytoid("jobpost","jkey",$kk);
		$sql="select * from jobpost where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectuserfornotify($kk)
	{
		$id=keytoid("notify","notkey",$kk);
		$sql="select * from notify where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectuserforteamreg($kk)
	{
		$id=keytoid("teamreg","teamkey",$kk);
		$sql="select * from teamreg where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectuserfortrackreg($kk)
	{
		$id=keytoid("tracking","trackkey",$kk);
		$sql="select * from tracking where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectusercomplaint($kk)
	{
		$id=keytoid("complaintreg","cmpkey",$kk);
		$sql="select * from complaintreg where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function updateshipreg($a,$b,$c,$d,$e,$f,$g,$h,$i,$kk)
	{
		$id=keytoid("shipreg","skey",$kk);
		$sql="update shipreg set sid='".$a."',sname='".$b."',smaxwt='".$c."',sheight='".$d."',swidth='".$e."',sfrom='".$f."',sto='".$g."',sstime='".$h."',srtime='".$i."' where id='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Ship Updation Successful')</script>";
		else
			echo"<script>alert('Ship Updation not succeful')</script>";
	}

	function updatestaffreg($a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$s,$ckey)
	{
		$id=keytoid("login","lkey",$ckey);
		$sql="update staffreg set cname='".$a."',caddr='".$b."',cpin='".$c."',cstate='".$d."',cdistrict='".$e."',gender='".$f."',age='".$g."',cphno='".$h."',cemail='".$i."',ships='".$s."',desig='".$j."' where staffid='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		if($conn)
			echo"<script>alert('Profile Updation Successful')</script>";
		else
			echo"<script>alert('Profile Updation not succeful')</script>";
	}



	function selectusershipreg($kk)
	{
		$id=keytoid("shipreg","skey",$kk);
		$sql="select * from shipreg where id='".$id."'";

		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectuserrefundreg($kk)
	{
		$id=keytoid("refundreg","rfkey",$kk);
		$sql="select * from refundreg where id='".$id."'";
	//	echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectusercategory($kk)
	{
		$id=keytoid("categoryreg","categorykey",$kk);
		$sql="select * from categoryreg where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	function selectusercatadd($kk)
	{
		$id=keytoid("catadd","catkey",$kk);
		$sql="select * from catadd inner join categoryreg on categoryreg.id=catadd.catid where catadd.id='".$id."'";
		//echo $sql;exit;
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}


	function selectuserexportreg($kk)
	{
		$id=keytoid("exportreg","exkey",$kk);
		$sql="select * from exportreg where id='".$id."'";
		$conn=mysql_query($sql);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

	//.......................................................................................
	function selectexportregadmin($a)
	{
		$cid=keytoid("login","lkey",$a);
		$sql1="select * from exportreg inner join shipreg on shipreg.sname=exportreg.cship where shipreg.loginid='".$cid."'";
		//echo $sql1;exit;

		$conn=mysql_query($sql1);
		$ar=array();
		while($ret=mysql_fetch_array($conn))
		{
			$ar[]=$ret;
		}
		return $ar;
	}

}
?>
