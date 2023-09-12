<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    /* Hide the sub-items by default */
    .nav-sub-items {
        display: none;
        list-style-type: none; /* Remove bullet points */
        margin-left: 20px;    /* Indent sub-items */
        margin-top: 10px;        /* Remove top margin */
        margin-bottom: 0;     /* Remove bottom margin */
        padding: 0;           /* Remove padding */
    }
    .nav-sub-item {
        margin: 5px 0;        /* Adjust spacing between sub-items */
    }
    /* Display the sub-items when parent nav-item is hovered */
    .nav-item:hover .nav-sub-items {
        display: block;
    }
    .nav-sub-item.active {
        background-color: purple;  /* Full purple background for active state */
        color: white;              /* White text color for active state */
    }
    .nav-sub-item.active a.nav-link {
        color: white;              /* White text color for active state */
    }
     .nav-item:hover > a.nav-link, .nav-item.active > a.nav-link {
        background-color: purple;  /* Purple background for active/hover state */
        color: white;              /* White text color for active/hover state */
    }
    .nav-item.active .nav-sub-items {
        display: block;
    }
</style>
<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
    <div class="logo">
        <a class="navbar-brand" href="../"><img src="../assets/img/favicon.png" alt="PMMS" title="PMMS" style="width: 50%; margin: 0 25%;"></a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="./#">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#profile">
                    <i class="material-icons">account_circle</i>
                    <p>Profile</p>
                </a>
            </li>


            <?php
                if ( $_SESSION['userType'] == 'Resolver' )
                {
            ?>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="material-icons">description</i>
                    <p>Tickets</p> 
                </a>
                <!-- Sub-items for Tickets -->
                <ul class="nav-sub-items">
                    <li class="nav-sub-item">
                        <a id="byyou" class="nav-link" href="#process">
                            <i class="material-icons">comment</i>
                            <p>Tickets By You</p>
                        </a>
                    </li>
                    <li id="toyou" class="nav-sub-item">
                        <a class="nav-link" href="#processtoyou">
                            <i class="material-icons">message</i>
                            <p>Tickets To You</p>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
                }
            ?>
            <?php
                if ( $_SESSION['userType'] == 'Admin' )
                {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#users">
                    <i class="material-icons">group</i>
                    <p>Users</p>
                </a>
            </li>
            <?php
                }
                if ( $_SESSION['userType'] == 'Admin' )
                {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#departments">
                    <i class="material-icons">category</i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="material-icons">description</i>
                    <p>Tickets</p> 
                </a>
                <!-- Sub-items for Tickets -->
                <ul class="nav-sub-items">
                    <li id="toyou" class="nav-sub-item">
                        <a class="nav-link" href="#processtoyou">
                            <i class="material-icons">message</i>
                            <p>Tickets To You</p>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
                }
                if ( $_SESSION['userType'] == 'User' )
                {
            ?>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="material-icons">description</i>
                        <p>Tickets</p> 
                    </a>
                        <!-- Sub-items for Tickets -->
                    <ul class="nav-sub-items">
                        <li class="nav-sub-item">
                        <a id="byyou" class="nav-link" href="#process">
                            <i class="material-icons">comment</i>
                            <p>Tickets By You</p>
                        </a>
                        </li>
                    </ul>
                </li>
            <!--<li class="nav-item">
                <a class="nav-link" href="#announcements">
                    <i class="material-icons">add_alert</i>
                    <p>Announcements</p>
                </a>
            </li>-->
            <?php
                }
            ?>
            
            <script>
                $(document).ready(function() {
            // Handle click event on nav-sub-item
                    $('.nav-sub-item').click(function(event) {
            // Prevent the event from bubbling up to parent elements
                        event.stopPropagation();
            // Remove active class from all other sub-items
                         $('.nav-sub-item').removeClass('active');
            // Add active class to the clicked sub-item
                        $(this).addClass('active');
                        $(this).closest('.nav-item').addClass('active');
                    });
                    $('.nav-item').click(function(event){
                        $('.nav-sub-item').removeClass('active');
                    });
                });

            </script>
        </ul>
    </div>
</div>