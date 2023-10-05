<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Team Meet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row vh-100 overflow-hidden">

            <!-- user profile area -->
            <div class="col-2 user-profile-area">
                <div class="row">

                    <div class="text-center mt-4 d-flex justify-content-center gap-1 ">
                        <h3 class="fw-bold">TEAM MEET</h3>
                        <span>&trade;</span>
                    </div>

                    <div class="d-flex flex-column align-items-center py-5 ">

                        <img src="resources/emptyUser.png" class="rounded-5" height="75px" width="75px" id="viewImage" />

                        <h6 class="fw-semibold mt-3 text-center">Mohamed Rimas</h6>


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

                                    <label class="text-white" id="liveDateTime1"></label>
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
                                        <span class="fw-semibold">12</span>
                                    </div>
                                </div>

                                <div class="dashboard-total-donations d-flex justify-content-center align-items-center p-4 rounded-4">
                                    <i class="fa-solid fa-calendar-check" style="color: #088395;"></i>
                                    <div class="d-flex flex-column ps-3 justify-content-center ">
                                        <span>Completed Tasks</span>
                                        <span class="fw-semibold"> 23</span>
                                    </div>
                                </div>

                                <div class="dashboard-total-donations d-flex justify-content-center align-items-center p-4 rounded-4">
                                    <i class="fa-solid fa-calendar-plus fa-fade" style="color: #088395;"></i>
                                    <div class="d-flex flex-column ps-3 justify-content-center ">
                                        <span class="fw-bold">Pending Tasks</span>
                                        <span class="fw-bold">123</span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 mt-3 rounded-4 d-flex justify-content-between ">
                                <div class="chart py-3 px-4 bg-white rounded-4 d-flex flex-column align-items-center justify-content-between ">
                                    <div class="d-flex flex-column p-3">
                                        <span class="fw-semibold">Completed tasks for 2023</span>
                                        <span style="font-size: 12px;">Recently completed 5 tasks in nutshell</span>
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
                                                    <th scope="col" class="border-bottom">#</th>
                                                    <th scope="col" class="border-bottom">Task Id</th>
                                                    <th scope="col" class="border-bottom">Project name</th>
                                                    <th scope="col" class="border-bottom">Submitted date</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">22</td>
                                                    <td class="border-bottom">Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">333</td>
                                                    <td class="border-bottom">Maha Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Seeya Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Meemuththa Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Dad Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Meemuththa Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Dad Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

                                                <tr>
                                                    <td class="border-bottom">1</td>
                                                    <td class="border-bottom">444</td>
                                                    <td class="border-bottom">Meemuththa Sona</td>
                                                    <td class="border-bottom">2023-10-03 10:12:23</td>
                                                </tr>

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
                                            <th scope="col" class="border-bottom">#</th>
                                            <th scope="col" class="border-bottom">Title of the task</th>
                                            <th scope="col" class="border-bottom">Project name</th>
                                            <th scope="col" class="border-bottom">Leader</th>
                                            <th scope="col" class="border-bottom">Issued date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="border-bottom">1</td>
                                            <td class="border-bottom">Create a sign in page</td>
                                            <td class="border-bottom">Sona</td>
                                            <td class="border-bottom">sachinthaPadaya@gmail.com</td>
                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                        </tr>

                                        <tr>
                                            <td class="border-bottom">1</td>
                                            <td class="border-bottom">Create a sign in page</td>
                                            <td class="border-bottom">Sona</td>
                                            <td class="border-bottom">sachinthaPadaya@gmail.com</td>
                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                        </tr>

                                        <tr>
                                            <td class="border-bottom">1</td>
                                            <td class="border-bottom">Create a sign in page</td>
                                            <td class="border-bottom">Sona</td>
                                            <td class="border-bottom">sachinthaPadaya@gmail.com</td>
                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                        </tr>

                                        <tr>
                                            <td class="border-bottom">1</td>
                                            <td class="border-bottom">Create a sign in page</td>
                                            <td class="border-bottom">Sona</td>
                                            <td class="border-bottom">sachinthaPadaya@gmail.com</td>
                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                        </tr>

                                        <tr>
                                            <td class="border-bottom">1</td>
                                            <td class="border-bottom">Create a sign in page</td>
                                            <td class="border-bottom">Sona</td>
                                            <td class="border-bottom">sachinthaPadaya@gmail.com</td>
                                            <td class="border-bottom">2023-10-03 10:12:23</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>

                    </div>
                </div>

                <!-- projects -->
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
                </div>

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
                </div>


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

                <div class="modal-body d-flex flex-column justify-content-center align-items-center py-5 ">
                    <img src="resources/emptyUser.png" class="rounded-5 " height="120px" width="120px" id="viewUserImage" />
                    <div class="my-3 d-flex flex-column gap-3">
                        <input type="file" class="d-none" id="userProfileImage" accept="image/*" style="height: 200px;" />
                        <label for="userProfileImage" class="btn btn-dark" onclick="changeUserImage();">Change Image</label>
                    </div>

                    <div class="d-flex justify-content-between col-12 p-3">
                        <div class="d-flex flex-column col-5 ">
                            <span class="fw-semibold">First Name</span>
                            <input type="text" class="verification-input" value="" id="editFirstname">
                        </div>
                        <div class="d-flex flex-column col-5 ">
                            <span class="fw-semibold">Last Name</span>
                            <input type="text" class="verification-input" value="" id="editLastname">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between col-12 p-3">
                        <div class="d-flex flex-column col-5 ">
                            <span class="fw-semibold">Mobile</span>
                            <input type="text" class="verification-input" value="" id="editMobile">
                        </div>
                        <div class="d-flex flex-column col-5 ">
                            <span class="fw-semibold">Password</span>
                            <input type="password" class="verification-input" value="" id="editPassword">
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
                    <button type="button" class="btn btn-primary border-0" style="background-color: #088395;" onclick="editUserDetails();">Edit Details</button>
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

    <script>
        const ctx2 = document.getElementById('LineChart');

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Tasks',
                    data: [65, 59, 80, 81, 56, 55, 40],
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