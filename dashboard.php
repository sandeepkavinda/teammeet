<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Dashboard | Team Meet</title>

        <link rel="icon" href="resources/teameet.png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row vh-100 overflow-hidden">

                <?php

                $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION['user']['email'] . "'");
                $user = $rs->fetch_assoc();

                ?>

                <!-- user profile area -->
                <div class="col-2 user-profile-area">
                    <div class="row">

                        <div class="text-center mt-4 d-flex justify-content-center gap-1 ">
                            <h3 class="fw-bold">TEAM MEET</h3>
                            <span>&trade;</span>
                        </div>

                        <div class="d-flex flex-column align-items-center py-5 ">

                            <div class="profile_pic" style="background-image: url('<?php echo ($user['profile_url']); ?>');"></div>

                            <h6 class="fw-semibold mt-3 text-center"><?php echo $user['first_name'] . " " . $user['last_name'] ?></h6>


                            <button class="edit-profile p-2 rounded-2 mt-2" onclick="userProfileBox();"><i class="fa-solid fa-wrench"></i>&nbsp;&nbsp;Edit profile</button>
                        </div>

                        <div class="sideBar-options col-12 mt-3">
                            <div class="nav flex-column" role="tablist" aria-orientation="vertical">
                                <nav class="nav flex-column">
                                    <a class="nav-link activeTab " id="list-1" onclick="listChange('1');"><i class="fa-solid fa-gauge pe-2"></i>&nbsp; Dashboard</a>
                                    <a class="nav-link" id="list-2" onclick="listChange('2');"><i class="fa-solid fa-folder-open pe-2 "></i>&nbsp; Projects</a>
                                    <a class="nav-link" id="list-3" onclick="listChange('3');"><i class="fa-solid fa-list-check pe-2 "></i>&nbsp; Tasks</a>
                                    <a class="nav-link" id="list-4" onclick="listChange('4');"><i class="fa-solid fa-comments pe-2 "></i>&nbsp; Message</a>
                                </nav>
                            </div>
                        </div>

                        <div class="fixed-bottom my-4 col-2 text-center">
                            <button class="edit-profile p-2 rounded-2"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Log Out</button>
                        </div>

                    </div>
                </div>

                <!-- user pages area -->
                <div class="user-pages-area col-10 vh-100 ">

                    <!-- dashboard -->
                    <div class="col-12 d-block vh-100" id="dashboard">
                        <div class="row">

                            <div class="area-header col-12 p-3" id="area-header">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-gauge fs-4"></i>&nbsp;&nbsp;Dashboard</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">

                                        <label class="text-white" id="liveDateTime"></label>
                                        <i class="fa-regular fa-bell text-white fs-4" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-custom-class="custom-popover" data-bs-title="Notifications" data-bs-content="You have already seen all notifications"></i>

                                    </div>

                                </div>
                            </div>

                            <div class="area-body col-12 p-3 overflow-y-scroll" id="area-body">

                                <div class="dashboard-boxes col-12 d-flex justify-content-between gap-2">

                                    <div class="dashboard-total-donations d-flex justify-content-center align-items-center rounded-4">
                                        <i class="fa-solid fa-folder" style="color: #088395;"></i>
                                        <div class="d-flex flex-column ps-3 justify-content-center ">
                                            <span>My Projects</span>
                                            <?php
                                            $rs2 = Database::search("SELECT * FROM `project` ");
                                            $rs2_num = $rs2->num_rows;
                                            ?>
                                            <span class="fw-semibold"><?php echo ($rs2_num) ?> Projects</span>
                                        </div>
                                    </div>

                                    <div class="dashboard-total-donations d-flex justify-content-center align-items-center p-4 rounded-4">
                                        <i class="fa-solid fa-calendar-check" style="color: #088395;"></i>
                                        <div class="d-flex flex-column ps-3 justify-content-center ">
                                            <span>Completed Tasks</span>
                                            <?php
                                            $rs3 = Database::search("SELECT * FROM `task` INNER JOIN `task_members` ON `task`.`id` = `task_members`.`task_id` WHERE `user_email`='" . $_SESSION['user']['email'] . "' AND `task_status_id`='3'");
                                            $rs3_num = $rs3->num_rows;
                                            ?>
                                            <span class="fw-semibold">
                                                <?php
                                                if ($rs3_num == 1) {
                                                    echo ($rs3_num . " Task");
                                                } else {
                                                    echo ($rs3_num . " Tasks");
                                                } ?>

                                            </span>
                                        </div>
                                    </div>

                                    <div class="dashboard-total-donations d-flex justify-content-center align-items-center p-4 rounded-4">
                                        <i class="fa-solid fa-calendar-plus fa-fade" style="color: #088395;"></i>
                                        <div class="d-flex flex-column ps-3 justify-content-center ">
                                            <span class="">In Progress Tasks</span>
                                            <?php
                                            $rs4 = Database::search("SELECT * FROM `task` INNER JOIN `task_members` ON `task`.`id` = `task_members`.`task_id` WHERE `user_email`='" . $_SESSION['user']['email'] . "' AND `task_status_id`='2'");
                                            $rs4_num = $rs4->num_rows;
                                            ?>
                                            <span class="fw-bold">
                                                <?php
                                                if ($rs4_num == 1) {
                                                    echo ($rs4_num . " Task");
                                                } else {
                                                    echo ($rs4_num . " Tasks");
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>



                                <div class="col-12 mt-3 rounded-4 d-flex justify-content-between ">
                                    <div class="chart py-3 px-4 bg-white rounded-4 d-flex flex-column align-items-center justify-content-between ">
                                        <div class="d-flex flex-column p-3">
                                            <span class="fw-semibold">Completed tasks for 2023</span>
                                        </div>
                                        <canvas id="LineChart"></canvas>
                                    </div>
                                    <div class="recent-tasks px-2 bg-white rounded-4 justify-content-center ">
                                        <div class="col-12 d-flex flex-column align-items-center mt-3 p-3 rounded-4">
                                            <span class="fw-semibold fs-6" style="color: #071952;"><i class="fa-solid fa-angles-down pe-3 "></i>Recently completed tasks</span>
                                            <span style="font-size: 12px;">Recently completed 5 tasks in nutshell</span>
                                        </div>
                                        <!-- table -->
                                        <div class="col-12 mt-3 px-2 rounded-4 ">
                                            <table class="table rounded-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="border-bottom">Task Id</th>
                                                        <th scope="col" class="border-bottom">Project name</th>
                                                        <th scope="col" class="border-bottom">Submitted date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $rs6 = Database::search("SELECT * FROM `task` 
                                                    INNER JOIN `project` ON `task`.`project_id` = `project`.`id` 
                                                    INNER JOIN `task_members` ON `task`.`id` = `task_members`.`task_id` 
                                                    WHERE `user_email`='" . $_SESSION['user']['email'] . "' AND  `task_status_id`='3'");
                                                    $rs6_num = $rs6->num_rows;

                                                    for ($x = 0; $x < $rs6_num; $x++) {
                                                        $rs6_data = $rs6->fetch_assoc();
                                                    ?>

                                                        <tr>
                                                            <td class="border-bottom"><?php echo ($rs6_data['id']); ?></td>
                                                            <td class="border-bottom"><?php echo ($rs6_data['project_name']); ?></td>
                                                            <td class="border-bottom"><?php echo ($rs6_data['task_submitted_datetime']); ?></td>
                                                        </tr>

                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-column bg-white mt-3 p-3 rounded-4 ">
                                    <span class="fw-semibold fs-6" style="color: #071952;"><i class="fa-solid fa-angles-down pe-3 "></i>Recently recieved tasks</span>
                                    <span style="font-size: 12px;">In here, you can see your recent 5 tasks in nutshell</span>
                                </div>


                                <!-- table -->
                                <div class="col-12 mt-3 rounded-4 ">
                                    <table class="table rounded-table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border-bottom">Title of the task</th>
                                                <th scope="col" class="border-bottom">Project name</th>
                                                <th scope="col" class="border-bottom">Leader</th>
                                                <th scope="col" class="border-bottom">Added date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $rs7 = Database::search("SELECT * FROM `task` 
                                                    INNER JOIN `project` ON `task`.`project_id` = `project`.`id` 
                                                    INNER JOIN `task_members` ON `task`.`id` = `task_members`.`task_id` 
                                                    WHERE `user_email`='" . $_SESSION['user']['email'] . "' AND `task_status_id`='3'");
                                            $rs7_num = $rs7->num_rows;

                                            for ($x = 0; $x < $rs7_num; $x++) {
                                                $rs7_data = $rs7->fetch_assoc();
                                            ?>

                                                <tr>
                                                    <td class="border-bottom"><?php echo ($rs7_data["task_title"]); ?></td>
                                                    <td class="border-bottom"><?php echo ($rs7_data["project_name"]); ?></td>
                                                    <td class="border-bottom"><?php echo ($rs7_data["task_leader"]); ?></td>
                                                    <td class="border-bottom"><?php echo ($rs7_data["task_added_datetime"]); ?></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>


                    <!-- projects -->
                    <div class="col-12 d-none vh-100" id="projects">
                        <div class="row">

                            <div class="area-header col-12 p-3" id="project-header">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-folder-open fs-4 "></i>&nbsp;&nbsp;projects</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">
                                        <div class="text-white" style="cursor: pointer;" onclick="createProject();"><i class="fa-solid fa-folder-plus"></i>&nbsp; Create Project</div>
                                    </div>
                                </div>
                            </div>

                            <div class="area-body col-12 p-3 overflow-y-scroll" id="project-body">

                                <div class="col-12 bg-white rounded-4 ">

                                    <div class="col-12 p-4 d-flex justify-content-between">
                                        <div class="col-7">
                                            <span class="fw-semibold">Search by project name</span>
                                            <div class="input-group mt-2 px-3 py-2 border rounded-3">
                                                <span class="input-group-text fw-bold border-0 bg-transparent"><i class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" class="form-control shadow-none border-0" id="search-project">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <span class="fw-semibold">Sort by</span>
                                            <div class="input-group mt-2 px-3 py-2 border rounded-3 ">
                                                <select class="form-select border-0 shadow-none" aria-label="Default select example">
                                                    <option selected value="0">Date & Time Desc</option>
                                                    <option value="1">Date & Time Asc</option>
                                                    <option value="2">Max amount</option>
                                                    <option value="3">Min amount</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12  ">

                                    <div class="col-12 d-flex flex-column bg-white mt-3 p-3 rounded-4 ">
                                        <span class="fw-semibold fs-6" style="color: #071952;"><i class="fa-solid fa-angles-down pe-3 "></i>Prject details</span>
                                        <span style="font-size: 12px;">In here, you can see your project details</span>
                                    </div>


                                    <div class="col-12 bg-white p-3 mt-3 rounded-4 ">
                                        <div class="accordion" id="accordionPanelsStayOpenExample">

                                            <div class="d-flex col-12">
                                                <div class="accordion-item col-11">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button shadow-none " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                            Sona
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                        <div class="accordion-body">

                                                            <div class="col-12 mt-3 px-3 rounded-4 ">
                                                                <table class="table ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" class="border-bottom bg-white fw-semibold text-dark">Title of task</th>
                                                                            <th scope="col" class="border-bottom bg-white fw-semibold text-dark">Status</th>
                                                                            <th scope="col" class="border-bottom bg-white fw-semibold text-dark">Issued date</th>
                                                                            <th scope="col" class="border-bottom bg-white fw-semibold text-dark">Deadline</th>
                                                                            <th scope="col" class="border-bottom bg-white fw-semibold text-dark">View details</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr><tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr><tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr><tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="border-bottom">Create a sign in page</td>
                                                                            <td class="border-bottom">To do</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                                                            <td class="border-bottom"><button class="btn btn-dark view-details" onclick="viewProjectDetails();">view</button></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1 d-flex justify-content-center mt-3 fs-5 "><i class="fa-solid fa-trash"></i></div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="col-12 mt-4 d-flex justify-content-center ">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item">
                                                    <a class="page-link paginationArrows shadow-none " href="#" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="page-link paginationArrows shadow-none " href="#">1</a></li>
                                                <li class="page-item"><a class="page-link paginationArrows shadow-none " href="#">2</a></li>
                                                <li class="page-item"><a class="page-link paginationArrows shadow-none " href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link paginationArrows shadow-none " href="#" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- projects
                    <div class="col-12 d-none " id="projects">
                        <div class="row">

                            <div class="area-header col-12 p-3">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-folder-open fs-4 "></i>&nbsp;&nbsp;projects</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">
                                        <label class="text-white" id="liveDateTime2"></label>
                                        <i class="fa-regular fa-bell text-white fs-4"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> -->

                    <!-- tasks -->
                    <div class="col-12 d-none " id="tasks">
                        <div class="row">

                            <div class="area-header col-12 p-3">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-list-check fs-4 "></i>&nbsp;&nbsp;Tasks</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">
                                        <label class="text-white" id="liveDateTime3"></label>
                                        <i class="fa-regular fa-bell text-white fs-4"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- message -->
                    <div class="col-12" id="message">
                        <div class="row">

                            <div class="area-header col-12 p-3" id="messsge-header">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-comments fs-4"></i>&nbsp;&nbsp;Message</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">
                                        <label class="text-white" id="liveDateTime4"></label>
                                        <i class="fa-regular fa-bell text-white fs-4"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 " id="message-body">
                                <div class="row shadow">
                                    <div class="col-12 col-lg-5 ">
                                        <div class="row bg-white px-3 rounded-3 h-100 ">

                                            <div class="col-12">
                                                <div class="row px-2">
                                                    <div class="input-group my-3" style="border-color: #088395; border-width: 2px; border-style: solid;">
                                                        <div class="col-11">
                                                            <input type="text" id="msg_txt" class="form-control rounded py-3 bg-light shadow-none border-0" placeholder="Search Project....">
                                                        </div>

                                                        <div class="col-1 d-flex justify-content-center align-items-center ps-2" id="send_btn"><i class="fa-solid fa-magnifying-glass fs-5"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="color: #088395;">Group Messages</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="color: #088395;">Direct Messages</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                        <div class="message_box" id="message_box">
                                                            <div class="list-group rounded-2">
                                                                <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 ">

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;">Project 1</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Task 1</p>
                                                                    </div>

                                                                </a>

                                                            </div>


                                                            <div class="list-group rounded-2">
                                                                <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 ">



                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;">Project</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Task 1</p>
                                                                    </div>

                                                                </a>

                                                            </div>

                                                            <div class="list-group rounded-2">
                                                                <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 ">



                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;">Project</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Task 1</p>
                                                                    </div>

                                                                </a>

                                                            </div>

                                                            <div class="list-group rounded-2">
                                                                <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 ">



                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;">Project</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Task 1</p>
                                                                    </div>

                                                                </a>

                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade message_box" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                                        <div class="mt-1 sent ">
                                                            <div class="list-group rounded-0">
                                                                <a href="#" class="list-group-item list-group-item-action text-black rounded-0 ">

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;"> Sandeep</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Last Chat</p>
                                                                    </div>

                                                                </a>

                                                            </div>
                                                        </div>

                                                        <div class="mt-1 sent ">
                                                            <div class="list-group rounded-0">
                                                                <a href="#" class="list-group-item list-group-item-action text-black rounded-0 ">

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;"> Rimas</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Last Chat</p>
                                                                    </div>

                                                                </a>

                                                            </div>
                                                        </div>

                                                        <div class="mt-1 sent ">
                                                            <div class="list-group rounded-0">
                                                                <a href="#" class="list-group-item list-group-item-action text-black rounded-0 ">

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;"> Sachintha</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Last Chat</p>
                                                                    </div>

                                                                </a>

                                                            </div>
                                                        </div>

                                                        <div class="mt-1 sent ">
                                                            <div class="list-group rounded-0">
                                                                <a href="#" class="list-group-item list-group-item-action text-black rounded-0 ">

                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold" style="color: #12486B;"> Bimbisha</h6>
                                                                            <small class="small fw-bold">2022-11-17
                                                                                17:03:29</small>

                                                                        </div>
                                                                        <p class="mb-0">Last Chat</p>
                                                                    </div>

                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-7 px-0 d-flex flex-column justify-content-between">

                                        <div class="px-4 py-5 text-white chat_box" id="chat_box">
                                            <!-- sender -->
                                            <div class="offset-3 w-75">

                                                <div class="col-12 d-flex rounded" style="background-color:  #088395;">
                                                    <div class="col-2  d-flex justify-content-center align-items-center">
                                                        <img src="profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                    </div>
                                                    <div class="col-10">
                                                        <p class="text-dark fw-bold fs-6 mt-2 " id="rmail">Daham
                                                            Bandara
                                                        </p>
                                                        <p class="mb-0 text-black-50 mb-2">Hi</p>
                                                    </div>

                                                </div>
                                                <p class="small fw-bold text-black-50 text-end px-1 mt-1">2022-11-17
                                                    17:03:29</p>
                                            </div>


                                            <!-- sender -->

                                            <!-- receiver -->
                                            <div class=" w-75">

                                                <div class="col-12 d-flex rounded" style="background-color:  #F5FCCD;">

                                                    <div class="col-2  d-flex justify-content-center align-items-center">
                                                        <img src="profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                    </div>
                                                    <div class="col-10">
                                                        <p class="text-dark fw-bold fs-6 mt-2" id="rmail">Danula
                                                            Gunawardana
                                                        </p>
                                                        <p class="mb-0 text-black-50 mb-2">Hi</p>
                                                    </div>

                                                </div>
                                                <p class="small fw-bold text-black-50 text-start px-1 mt-1">
                                                    2022-11-17
                                                    17:03:29</p>
                                            </div>


                                            <!-- receiver -->

                                            <div class="offset-3 w-75">

                                                <div class="col-12 d-flex rounded" style="background-color:  #088395;">
                                                    <div class="col-2  d-flex justify-content-center align-items-center">
                                                        <img src="profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                    </div>
                                                    <div class="col-10">
                                                        <p class="text-dark fw-bold fs-6 mt-2 " id="rmail">Daham
                                                            Bandara
                                                        </p>
                                                        <p class="mb-0 text-black-50 mb-2">Hi</p>
                                                    </div>

                                                </div>
                                                <p class="small fw-bold text-black-50 text-end px-1 mt-1">2022-11-17
                                                    17:03:29</p>
                                            </div>


                                            <div class="offset-3 w-75">

                                                <div class="col-12 d-flex rounded" style="background-color:  #088395;">
                                                    <div class="col-2  d-flex justify-content-center align-items-center">
                                                        <img src="profile_img/newuser.svg" width="50px" class="rounded-circle">
                                                    </div>
                                                    <div class="col-10">
                                                        <p class="text-dark fw-bold fs-6 mt-2 " id="rmail">Daham
                                                            Bandara
                                                        </p>
                                                        <p class="mb-0 text-black-50 mb-2">Hi</p>
                                                    </div>

                                                </div>
                                                <p class="small fw-bold text-black-50 text-end px-1 mt-1">2022-11-17
                                                    17:03:29</p>
                                            </div>




                                        </div>

                                        <!-- txt -->
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="input-group mb-3 px-4 mt-5 ">
                                                    <input type="text" id="msg_txt" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn">
                                                    <button class="btn btn-light fs-2" id="send_btn"><i class="fa-solid fa-paper-plane fs-5"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- txt -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Message
                    <div class="col-12 d-none " id="message">
                        <div class="row">

                            <div class="area-header col-12 p-3">
                                <div class="row">

                                    <div class="col-6 ps-4">
                                        <span class="fs-4 fw-semibold text-white"><i class="fa-solid fa-comments fs-4"></i>&nbsp;&nbsp;Message</span>
                                    </div>

                                    <div class="col-6 d-flex justify-content-end align-items-center gap-3 pe-4">
                                        <label class="text-white" id="liveDateTime4"></label>
                                        <i class="fa-regular fa-bell text-white fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userProfileModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5"><i class="fa-solid fa-wrench fs-5 "></i>&nbsp;&nbsp;Edit profile details</h1>
                    </div>

                    <div class="modal-body d-flex flex-column justify-content-center align-items-center py-3 ">


                        <div class="profile_pic" id="userProfileImageView" style="background-image: url('<?php echo ($user['profile_url']); ?>');"></div>

                        <span class="mt-2"><?php echo $user['email'] ?></span>
                        <span>Joined on <?php echo $user['registered_date'] ?></span>

                        <div class="my-2 d-flex flex-column gap-3">
                            <input type="file" class="d-none" id="profileImg" accept="image/*" style="height: 200px;" />
                            <label for="profileImg" class="btn btn-dark" onclick="changeUserImage();">Change Image</label>
                        </div>

                        <div class="d-flex justify-content-between col-12 p-3">
                            <div class="d-flex flex-column col-5 ">
                                <span class="fw-semibold">First Name</span>
                                <input type="text" class="verification-input" value="<?php echo $user['first_name'] ?>" id="editFirstname">
                            </div>
                            <div class="d-flex flex-column col-5 ">
                                <span class="fw-semibold">Last Name</span>
                                <input type="text" class="verification-input" value="<?php echo $user['last_name'] ?>" id="editLastname">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between col-12 p-3">
                            <div class="d-flex flex-column col-12">
                                <span class="fw-semibold">Password</span>
                                <input type="password" class="verification-input" value="<?php echo $user['password'] ?>" id="editPassword">
                            </div>
                        </div>

                        <div class="col-12 p-3">
                            <div class="alert alert-info" role="alert">
                                <b>Note:</b> You can't edit primary data like email!
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary border-0" style="background-color: #088395;" onclick="userProfileUpdateProcess();">Update Details</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- loader Modal -->
        <div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body d-flex flex-column py-5 gap-1 justify-content-center align-items-center">
                        <img src="resources/success.gif" height="140px" width="140px" class="mt-2">
                        <h5 class="fw-semibold text-success">success!</h5>
                        <button class="btn btn-dark px-3" onclick="window.location.reload();">Continue</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="script.js"></script>
        <script src="https://kit.fontawesome.com/0dab43209e.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

        <script>
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <?php

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $year = $d->format("Y");
        $month = $d->format("m");

        $rs5 = Database::search("SELECT * FROM `task` INNER JOIN `task_members` ON `task`.`id` = `task_members`.`task_id`  
WHERE `user_email`='" . $_SESSION['user']['email'] . "' AND `task_added_datetime` LIKE '" . $year . "%' ");

        $rs5_num = $rs5->num_rows;

        $jan = 0;
        $feb = 0;
        $mar = 0;
        $apr = 0;
        $may = 0;
        $jun = 0;
        $jul = 0;
        $aug = 0;
        $sep = 0;
        $oct = 0;
        $nov = 0;
        $dec = 0;

        for ($x = 0; $x < $rs5_num; $x++) {

            $rs5_data = $rs5->fetch_assoc();

            $format = 'Y-m-d H:i:s';
            $dateTime = $rs5_data["task_added_datetime"];

            $dateTimeObject = DateTime::createFromFormat($format, $dateTime);
            $data_month = $dateTimeObject->format('m');

            if ($data_month == "01") {
                $jan = $jan + 1;
            } else if ($data_month == "02") {
                $feb = $feb + 1;
            } else if ($data_month == "03") {
                $mar = $mar + 1;
            } else if ($data_month == "04") {
                $apr = $apr + 1;
            } else if ($data_month == "05") {
                $may = $may + 1;
            } else if ($data_month == "06") {
                $jun = $jun + 1;
            } else if ($data_month == "07") {
                $jul = $jul + 1;
            } else if ($data_month == "08") {
                $aug = $aug + 1;
            } else if ($data_month == "09") {
                $sep = $sep + 1;
            } else if ($data_month == "10") {
                $oct = $oct + 1;
            } else if ($data_month == "11") {
                $nov = $nov + 1;
            } else if ($data_month == "12") {
                $dec = $dec + 1;
            }
        }
        ?>


        <script>
            const ctx2 = document.getElementById('LineChart');

            new Chart(ctx2, {
                type: 'bar',
                data: {

                    labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Tasks',
                        data: [
                            <?php echo ($jan); ?>,
                            <?php echo ($feb); ?>,
                            <?php echo ($mar); ?>,
                            <?php echo ($apr); ?>,
                            <?php echo ($may); ?>,
                            <?php echo ($jun); ?>,
                            <?php echo ($jul); ?>,
                            <?php echo ($aug); ?>,
                            <?php echo ($sep); ?>,
                            <?php echo ($oct); ?>,
                            <?php echo ($nov); ?>,
                            <?php echo ($dec); ?>
                        ],
                        backgroundColor: [
                            '#088395'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                    }]
                },

                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                        }
                    }
                }
            });
        </script>


    </body>

    </html>

<?php
} else {
    header("Location:authentication.php");
}
?>