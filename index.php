<?php 
function date_range_string($beginDateString, $endDateString)
{
	$beginDate = date_create($beginDateString);
	
	if ($endDateString == 'Present') {
		$endDate = date_create(date());
	} else {
		$endDate = date_create($endDateString);
	}
	
	$diff = date_diff($beginDate, $endDate, true);
	$years = $diff->format('%y');
	$months = $diff->format('%m');
	$days = $diff->format('%d');
	
	if ($days >= 15) {
		if ($months == 11) {
			$months = 0;
			$years = $years + 1;
		} else {
			$months = $months + 1;
		}
	}
	
	$returnString = '<p class="locationdaterange">'.date_format($beginDate, 'F Y').'&ndash;';
		
	if ($endDateString == 'Present') {
		$returnString = $returnString.'Present';
	} else {
		$returnString = $returnString.date_format($endDate, 'F Y');
	}
	
	$returnString = $returnString.' <span class="grey">(';
	
	if ($years > 0) {
		$returnString = $returnString.$years.'Y';
	}
	
	if (($months > 0) and ($years > 0)) {
		$returnString = $returnString.'&nbsp;';
	}
	
	if (($months > 0) or ($years = 0)) {
		$returnString = $returnString.$months.'M';
	}
	
	$returnString = $returnString.')</span></p>';
	
	return $returnString;
}


function location_map($latitude,$longitude)
{	
	$xTranslate = max(min(-$longitude / 5.625, 32), -32);
	$yTranslate = max(min($latitude / 4.5, 10), -13);
	
	$returnString = '<svg width="14" height="14" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"><g transform="translate('.$xTranslate.','.$yTranslate.')"><path d="M53,34L49,32L51,32L49,31L51,31L52,30L58,30L58,37L-32,37L-32,27L-25,27L-21,29L-22,30L-22,32L-21,33L-19,34L-11,34L-15,32L-13,32L-15,31L-13,31L-12,30L-5,30L-5,29L0,29L0,28L1,28L3,26L2,28L2,30L1,31L-1,31L-1,32L1,33L5,33L7,32L8,32L7,31L9,30L10,30L11,29L13,29L15,28L20,28L22,27L23,27L25,28L25,29L29,27L39,27L43,29L42,30L42,32L43,33L45,34L53,34ZM5,31L5,32L3,32L4,31L5,31ZM-1,11L-1,14L0,16L1,17L0,19L0,24L1,25L2,25L1,24L2,22L2,21L6,17L6,16L7,14L6,13L5,13L3,11L2,11L1,10L-1,11ZM-24,21L-25,21L-25,22L-24,21ZM40,21L39,21L39,22L40,21ZM-20,20L-20,21L-21,22L-20,22L-19,21L-19,20L-20,20ZM44,20L44,21L43,22L44,22L45,21L45,20L44,20ZM38,15L38,16L37,15L36,15L35,16L33,17L33,18L34,20L36,19L37,19L39,21L41,19L41,18L38,15ZM-26,15L-26,16L-27,15L-28,15L-29,16L-31,17L-31,18L-30,20L-28,19L-27,19L-25,21L-23,19L-23,18L-26,15ZM10,8L10,10L12,12L15,12L15,13L16,15L15,16L17,20L18,20L19,19L20,17L20,14L22,12L22,10L21,11L19,7L17,6L17,7L15,6L15,5L12,6L10,8ZM22,15L21,16L21,18L22,17L22,15ZM37,13L38,13L40,14L40,15L38,14L37,13ZM-27,13L-26,13L-24,14L-24,15L-26,14L-27,13ZM33,12L33,13L34,14L35,14L35,13L34,13L34,11L33,12ZM-31,12L-31,13L-30,14L-29,14L-29,13L-30,13L-30,11L-31,12ZM12,5L12,4L13,4L13,2L14,2L15,1L17,1L17,-1L18,-2L17,-2L16,-1L16004,1L15,0L14,0L14,-1L16,-3L19,-3L21,-2L23,-3L25,-3L25,-4L27,-4L29,-5L31,-5L32,-6L34,-5L34,-4L36,-4L37,-3L39,-4L41,-3L45,-3L47,-2L46,-1L45,-2L45,-1L43,0L41,2L41,1L43,-1L42,-1L41,0L39,0L38,1L38,3L37,4L36,4L36,6L35,5L34,5L35,6L35,7L34,8L32,9L33,10L32,11L31,10L31,11L32,12L32,14L30,12L31,12L30,10L30,9L29,8L27,10L27,11L26,9L25,8L24,8L22,7L23,8L24,8L22,10L21,10L20,8L19,7L19,6L18,5L18,4L17,5L16,4L16,5L15,4L14,4L13,5L12,5ZM-30,9L-30,10L-29,11L-29,12L-28,12L-28,11L-29,10L-29,9L-30,9ZM34,9L34,10L35,11L35,12L36,12L36,11L35,10L35,9L34,9ZM-14,0L-12,0L-9,3L-9,5L-8,6L-7,8L-7,6L-6,8L-6,9L-4,10L-3,10L-2,11L-1,11L-2,10L-2,8L-3,9L-4,9L-4,7L-2,7L-1,8L-1,6L1,4L2,4L2,2L3,2L2,3L4,3L3,2L3,1L2,0L1,0L0,-1L-1,-1L-1,2L-2,1L-4,0L-3,-1L-1,-1L-2,-3L-1,-3L1,-1L2,-1L1,-2L2,-2L0,-4L-1,-4L-1,-5L0,-6L2,-7L1,-8L-1,-8L-3,-7L-4,-6L-4,-4L-5,-4L-4,-3L-5,-3L-6,-4L-7,-4L-8,-5L-9,-4L-9,-3L-12,-3L-14,-4L-15,-4L-16,-3L-15,-2L-16,-2L-15,-1L-16,-1L-16,0L-15,0L-16,1L-14,0ZM-32,-6L-30,-5L-30,-4L-28,-4L-27,-3L-25,-4L-23,-3L-19,-3L-17,-2L-18,-1L-19,-2L-19,-1L-21,0L-23,2L-23,1L-21,-1L-22,-1L-23,0L-25,0L-26,1L-26,3L-27,4L-28,4L-28,6L-29,5L-30,5L-29,6L-29,7L-30,8L-32,9L-31,10L-32,11L-32,-6ZM58,-4L57,-4L56,-5L55,-4L55,-3L52,-3L50,-4L49,-4L48,-3L49,-2L48,-2L49,-1L48,-1L48,0L49,0L48,1L50,0L52,0L55,3L55,5L56,6L57,8L57,6L58,8L58,-4ZM-25,3L-26,3L-26,5L-27,6L-27,7L-25,5L-25,3ZM39,3L38,3L38,5L37,6L37,7L39,5L39,3ZM12,0L13,0L13,2L12,2L11,1L12,1L12,0ZM5,0L4,-1L4,-3L3,-4L3,-5L1,-5L0,-6L1,-6L5,-8L9,-8L11,-7L10,-6L10,-4L9,-3L7,-2L6,-2L5,0ZM11,-2L10,-1L9,-1L9,-2L11,-2ZM22,-4L24,-5L25,-5L23,-4L23,-3L22,-4ZM15,-6L17,-7L18,-7L17,-5L16,-5L15,-6ZM29,-7L30,-7L32,-6L31,-6L29,-7Z" style="fill-opacity:0.66;"/></g>
    <path d="M13,0C20.175,0 26,5.825 26,13C26,20.175 20.175,26 13,26C5.825,26 0,20.175 0,13C0,5.825 5.825,0 13,0ZM13,2C19.071,2 24,6.929 24,13C24,19.071 19.071,24 13,24C6.929,24 2,19.071 2,13C2,6.929 6.929,2 13,2Z"/>
    <path d="M13,26L0,26L0,0L26,0L26,26L13,26C20.175,26 26,20.175 26,13C26,5.825 20.175,0 13,0C5.825,0 0,5.825 0,13C0,20.175 5.825,26 13,26Z" style="fill:white;"/>
</svg>';
	
	return $returnString;	
}


// Determine seasonally-appropriate background color based on month, northern or southern hemisphere
$ch = curl_init('https://freegeoip.app/json/'.$_SERVER['REMOTE_ADDR']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$apiResponse = curl_exec($ch);
curl_close($ch);

$ipInfo = json_decode($apiResponse, true);

$month = date("n");

if ($month == 12) {
	$season = 1;
} else {
	$season = ceil(($month + 1) / 3);
}

if (!empty($ipInfo)) {
	$latitude = $ipInfo['latitude'];
} else {
	$latitude = 0;
}

if ($latitude < 0) {
	$season = fmod($season + 1, 4) + 1;
}

switch ($season) {
	case 1: //Winter grey
		$seasonColorString = '30, 30, 35, 1';
		break;
	case 2: //Spring green
		$seasonColorString = '10, 40, 30, 1';
		break;
	case 3: //Summer blue
		$seasonColorString = '10, 30, 60, 1';
		break;
	case 4: //Fall red
		$seasonColorString = '60, 10, 20, 1';
		break;
	default:
		$seasonColorString = '30, 60, 10, 1';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Samuel Garen">
	<meta name="description" content="Professional biography of Samuel Garen - data analyst and project manager with Adidas AG">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>
		Samuel Garen&ensp;&#8226;&ensp;Data Solutions
	</title>
	
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
	<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon.png">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#000000"> <!-- Safari pinned tab icon and color -->
	<meta name="msapplication-TileColor" content="#000000"> <!-- Windows 10 icon and tile color -->
	<meta name="theme-color" content="#000000"> <!-- Android task bar switcher color -->
	<link rel="manifest" href="site.webmanifest">
	
	<link rel="stylesheet" type="text/css" href="style.css" />	
</head>

<?php
	echo '<body style=\'background-color: rgba('.$seasonColorString.');\'>';
?>
	
	<div class="contentframe">
	
		<div class="section" id="header">
			<img class="logopersonal" src="logo_sg_with_title.svg" alt="Samuel Garen - Data Architect"/>
		</div>
		
		<div class="section" id="main">
			
			<h1>About Me</h1>

			<p>
				<img class="selfie" id="selfie" src="sam.jpg" alt="Photograph of Samuel Garen"/>
				<span class="smallcaps">Name:</span> Samuel Garen<br/>
				<span class="smallcaps">Pronouns:</span> He / Him<br/>
				<span class="smallcaps">Location:</span> Portland, Oregon
			</p>
			<p>I am an award-winning data analyst and project manager based in Portland, Oregon. I make complex information understandable and beautiful. Currently I help my business partners at Adidas execute data science and engineering projects to glean insights from large data sets and make better decisions through reporting, visualization, modeling, and predictive analysis.</p>
			<p>I believe in stripping problems to their foundations and building from there, focusing first upon simplicity, ease of use, usefulness, quality, and understandability. The best designs are essential, intuitive, and effortless to use, and it is only through close communication, careful research, dismantling of preconceptions, and meticulous attention to detail that this may be achieved.</p>
			
			<br/>

			<div class="navbar">
				<p class="navlabel">Navigation</p>
				<div class="navbuttonbox"><p class="navbutton"><a href="#experience">Experience</a></p></div>
				<div class="navbuttonbox"><p class="navbutton"><a href="#education">Education</a></p></div>
				<div class="navbuttonbox"><p class="navbutton"><a href="#keyskills">Key Skills</a></p></div>
				<div class="navbuttonbox"><p class="navbutton"><a href="#samplework">Sample Work</a></p></div>
				<div class="navbuttonbox"><p class="navbutton"><a href="#awards">Awards</a></p></div>
				<div class="navbuttonbox"><p class="navbutton"><a href="#getintouch">Contact Info</a></p></div>
			</div>
			
			<div class="spacer" id="experience"></div>

			<h1>Experience</h1>

			<a href="http://www.adidas-group.com"><img class="logo" src="logo_adidas.svg" alt="Adidas Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.adidas-group.com">Adidas AG</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.560,-122.696); ?>
					Portland, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Senior Manager of eCom Data Solutions</p>	
						<?php echo date_range_string('2021-05-16','Present'); ?></li>
					<li><p class="role">Manager of eCom Data Solutions</p>
						<?php echo date_range_string('2020-12-20','2021-05-15'); ?></li>
					<li><p class="role">Manager, Business Performance Analytics</p>
						<?php echo date_range_string('2019-12-16','2020-12-19'); ?></li>
					<li><p class="role">Assistant Manager, Business Performance Analytics</p>
						<?php echo date_range_string('2019-01-02','2019-12-15'); ?></li>
				</ul>
				<p>At Adidas, I lead a team of analysts and developers specializing in end-to-end data solutions for our business partners in the eCommerce division. Our work spans from constructing data sets and improving on our data foundation, through automated reporting, dashboarding, and construction of tools, to advanced analytics, modeling, and data science projects. Our team ensures our business partners have immediate and reliable access to critical information, we work to elevate, contextualize, and prioritize key data from massive datasets for our partners, and we provide critical insight and context to operational data to assist our partners in making data-driven decisions to steer the business. As a development team, we choose to remain intimately connected to local market operations to ensure we have deep knowledge of how the business operates, helping us develop faster, more efficiently, and letting us do so with reduced back-and-forth with client teams.</p>
			</div>

			<div class="spacer"></div>

			<a href="http://www.portlandgeneral.com"><img class="logo" src="logo_pge.svg" alt="Portland General Electric Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.portlandgeneral.com">Portland General Electric</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.516,-122.675); ?>
					Portland, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Independent Consultant, Operations and Analytics</p>
						<?php echo date_range_string('2014-04-01','2022-02-28'); ?></li>
				</ul>
				<p>Portland General Electric retained me as a consultant to assist with software solutions and data analysis for needs that could not be satisfied immediately by internal teams. Key projects included development of software tools to collect and parse arcane network performance data and aggregate this into readable reports, reducing labor for this reporting by 95%. Other projects included SQL training for internal business analysts, advisement on methodologies for producing actionable reporting based on available data, recommendations on best practices for research of non-communicative system nodes based on analysis of successful repair rates, and rapid-turnaround repair and support for preexisting scripts and other software tools.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Development of software packages and scripts in VBa, Python, and SQL for statistical analysis of systems performance and reliability data to meet immediate needs that could not be accommodated by internal development and data teams.</li>
					<li>Designed and implemented process improvements in support of major database and software system transition, decreasing labor on reporting tasks by 95% and reducing errors by 75%.</li>
					<li>Facilitated development of a library of technical documentation of above analytics tools and methodologies.</li>
					<li>Trained network data analysts on SQL language / Oracle SQL dialect, core concepts, and best practices as well as efficient use of Oracle SQL Developer.</li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.epiqglobal.com"><img class="logo" src="logo_epiq.svg" alt="Epiq Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.epiqglobal.com">Epiq Global</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.476,-122.783); ?>
					Beaverton, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Senior Project Coordinator / Senior Project Lead</p>
						<?php echo date_range_string('2018-03-16','2018-12-27'); ?></li>
					<li><p class="role">Project Coordinator / Project Lead</p>
						<?php echo date_range_string('2016-09-16','2018-03-15'); ?></li>
					<li><p class="role">Project Coordinator</p>
						<?php echo date_range_string('2015-10-05','2016-09-15'); ?></li>
				</ul>
				<p>At Epiq, I led multiple simultaneous projects to assist with recovery of damages related to large-scale, systematic banking fraud and other regulatory matters. Operating under intense regulatory and media scrutiny, these programs have successfully helped more than two&nbsp;million individuals and businesses recover over $2&nbsp;billion&nbsp;USD, while assisting auditors with identifying patterns of fraud and potential additional areas of investigation. To support these projects, I also acted as client liasion and project advisor to technical teams on a SaaS legal claim database management tool for client and regulator use, heavily customized for each settlement project. These projects were among the most sophisticated the company handled, each with revenues between $1&nbsp;million and $10&nbsp;million annually.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Served as key liaison and project lead to Fortune 500 clients and Big Four banks on four of the company’s largest projects, each exceeding $1 million in monthly revenue and together earning over one quarter of division revenue.</li>
					<li>Collaborated with Agile development team on bi-weekly sprints, attended daily scrums, provided business, functional, and technical requirements, approved wireframes and demos, and performed UAT for software updates to SaaS database management web application.</li>
					<li>Created series of process improvements and supporting software for a series of high-labor, error-prone mailings processes, reducing labor on these tasks by 88% to 97%.</li>
					<li>Developed software tools used by project team to administrate settlement projects, providing unique visibility, flexibility, and reportability, as well as forecasting four times more accurate than possible with previous tools.</li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.pdx.edu"><img class="logo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.510,-122.685); ?>
					Portland, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Graduate Teaching Assistant</p>
						<?php echo date_range_string('2012-09-27','2014-03-14'); ?></li>
				</ul>
				<p>At Portland State University, I acted as an assistant instructor in a series of undergraduate history courses, mostly concentrating on World History and the history of the Middle East. I received the honor from the professors I worked with to offer frequent presentations on the history of the Middle East to students, where I developed a presentation style characterized by bold, graphic typography, meaningful use of animation, and rich, rapid-fire imagery. I also polished skills in providing positive, constructive feedback and critique of ideas, which continues to serve me well.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Presented weekly lectures for undergraduate classes of 60 to 80 students in world history, classical history, and the history of the Middle East. Polished skills in public speaking, instruction, and clear presentation of complex information.</li>
					<li>Held regular discussion and mentoring sessions among students, including constructive critique of writing and analysis skills and techniques.</li>
					<li>Graded assignments, papers, and essays and provided constructive feedback to students.</li>
				</ul>
			</div>

			<div class="spacer" id="education"></div>

			<h1>Education</h1>

			<a href="http://www.pdx.edu"><img class="logo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.510,-122.685); ?>
					Portland, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Master's of Arts, History, Architectural History Focus (Unfinished)</p></li>
				</ul>
				<p>For graduate school, I elected to continue my work in architectural history, focusing upon the use of visual symbol and motif to communicate across linguistic and religio-cultural lines in the medieval Middle East, with additional focus upon the network of logistics and trade established that provided inspiration and materials which have profoundly influenced the architecture and material culture of the Middle East. Unfortunately, the intensification of the Syrian civil war and resultant destruction of the structure that was to be a focus of my thesis has forced me to place further work on hold.</p>
			</div>

			<div class="spacer"></div>

			<a href="http://www.pdx.edu"><img class="logo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.510,-122.685); ?>
					Portland, Oregon</p>
				<br/>
				<ul>
					<li><p class="role">Bachelor's of Science, History, Architectural History Focus</p></li>
					<li><p class="role">Minor, Architecture</p></li>
					<li><p class="role">Additional Study, Civil Engineering</p></li>
				</ul>
				<p>For my bachelor's degree, I knew I was excited about design, but did not immediately have a clear direction. I decided to build my own course of study by approaching design from three angles: civil engineering, architecture, and architectural history. I was honored to have work I produced in all three disciplines preserved in Portland State's archive as future teaching materials, as well as a number of designs presented by the School of Architecture to the National Architectural Accrediting Board in their successful arguments for accreditation.</p>
			</div>

			<div class="spacer"></div>

			<a href="http://www.spu.edu"><img class="logo" src="logo_spu.svg" alt="Seattle Pacific University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.spu.edu">Seattle Pacific University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(47.651,-122.364); ?>
					Seattle, Washington</p>
				<br/>
				<ul>
					<li><p class="role">Foundational Study, Classics and History</p></li>
				</ul>
			</div>

			<div class="spacer" id="keyskills"></div>

			<h1>Key Skills</h1>

			<h2>Interpersonal</h2>
			<div class="columns">
				<ul>
					<li>Project management</li>
					<li>Development and management of diverse teams</li>
					<li>Communication and public speaking</li>
					<li>Confident decision-making</li>
					<li>Building partnerships with clients and vendors</li>
					<li>Collaborative leadership</li>
					<li>Mentoring and employee development</li>
					<li>Strategic analysis and planning</li>
					<li>Problem resolution</li>
					<li>Product development</li>
					<li>Procedure design and implementation</li>
					<li>Risk assessment and mitigation</li>
					<li>Milestone tracking and reporting</li>
					<li>Quality assurance</li>
					<li>Operational efficiencies and process improvements</li>
					<li>Development and use of corporate brand identities</li>
				</ul>
			</div>

			<h2>Technical</h2>
			<div class="columns">
				<ul>
					<li>Adobe Analytics</li>
					<li>Adobe Creative Suite</li>
					<li>Agile, Kanban, Scrum, and Waterfall methodologies</li>
					<li>Alteryx Designer, Server, and Analytic Apps</li>
					<li>Amazon S3</li>
					<li>Azure DevOps Server</li>
					<li>Exasol / Exasol SQL Dialect</li>
					<li>Excel / VBa</li>
					<li>Financial modeling & analysis</li>
					<li>Google Analytics</li>
					<li>Hadoop / HUE / Hive / Impala</li>
					<li>HTML / CSS</li>
					<li>Jira</li>
					<li>Microstrategy</li>
					<li>Oracle SQL Developer / Dialect</li>
					<li>Predictive modeling & classification</li>
					<li>Python</li>
					<li>SAP HANA</li>
					<li>Selenium</li>
					<li>SketchUp</li>
					<li>SQL / Microsoft SQL Server</li>
					<li>Tableau</li>
					<li>Technical documentation</li>
				</ul>
			</div>
			
			<div class="spacer" id="samplework"></div>

			<h1>Sample Work</h1>

			<a href="https://public.tableau.com/app/profile/samuel.garen/viz/ProductSalesDashboard_16465010297070/ProductSalesDashboard"><img class="sampleworkimage" src="samplework_productdashboard.png" alt="Product Dashboard Thumbnail"/></a>
			<div class="textboxsamplework">
				<p class="employer"><a href="https://public.tableau.com/app/profile/samuel.garen/viz/ProductSalesDashboard_16465010297070/ProductSalesDashboard">Product Sales Dashboard</a></p>
				<p class="locationdaterange"><img class="iconinline" src="icon_tableau.svg" alt="Tableau logo" />Tableau</p>
				<p>This report provides detailed product sales metrics, enabling easy comparison to forecast, along with other derived metrics such as margin, discount rate, and average sales price. Metrics are displayed at top level for easy consumption, visualized by a number of key product and sales channel attributes, and broken further into the top products contributing to overall sales. Selectors at left allow visualizations to be easily changed among modes to help the user understand where overperformance and underperformance to forecast are coming from and filters allow the user to quickly drill down into key products. Histograms at lower right inform how sales are distributed by price and margin to ensure sales are generated profitably. Product color data is incorporated to assist in identifying trends.</p>
			</div>
			
			<div class="spacer" id="awards"></div>

			<h1>Awards</h1>
			
			<div class="awardcontainer">
				<div class="awardbox">
					<img class="awardimage" src="award_adidas.png" alt="Adidas Award" />
					<p class="awardlabel">eCommerce Division Peer Recognition</p>
					<p class="awarddate">Q4 2021</p>
				</div>

				<div class="awardbox">
					<img class="awardimage" src="award_adidas.png" alt="Adidas Award" />
					<p class="awardlabel">Special Recognition for Exceptional Performance</p>
					<p class="awarddate">Q4 2020</p>
				</div>

				<div class="awardbox">
					<img class="awardimage" src="award_adidas.png" alt="Adidas Award" />
					<p class="awardlabel">3-Cs "Confidence" Award for Outstanding Leadership</p>
					<p class="awarddate">Q3 2019</p>
				</div>

				<div class="awardbox">
					<img class="awardimage" src="award_psu.png" alt="Portland State University Award" />
					<p class="awardlabel">Rockstar Graduate Teaching Assistant</p>
					<p class="awarddate">Winter Term 2013</p>
				</div>
				
				<div class="awardbox">
					<img class="awardimage" src="award_psu.png" alt="Portland State University Award" />
					<p class="awardlabel">Rockstar Graduate Teaching Assistant</p>
					<p class="awarddate">Spring Term 2013</p>
				</div>
			</div>
		</div>
		
		<div class="section" id="getintouch">
			<h1 id="contact">Contact Info</h1>
		
			<a href="mailto:sdgaren@gmail.com"><img class="buttoncontact" src="contact_email_address.svg" alt="E-mail sdgaren@gmail.com" /></a>
			<a href="http://www.linkedin.com/in/sdgaren"><img class="buttoncontact" src="contact_linkedin_address.svg" alt="LinkedIn - linkedin.com/in/sdgaren"></a>
		</div>
	</div>
	
	<div class="spacer"></div>
	
</body>
</html>
