
 <style>

h2 {
    font-size: 18px;
    font-weight: 400;
}

.dashboard-tile:hover .tile-link {
    display: block;
}
.tile-link {
    position: absolute;
    display: none;
    z-index: 100;
}
#loading, .tile-link, .tile-link .tile-link-overlay {
    top: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
}
.tile-link .tile-link-overlay {
    position: absolute;
    background-color: #666;
    opacity: 0.5;
    filter: alpha(opacity=50);
    z-index: 10;
}
#loading, .tile-link, .tile-link .tile-link-overlay {
    top: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
}
.tile-link .tile-link-content {
    position: relative;
    width: 50%;
    margin: 0 auto;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
}


.dashboard-tile:hover .tile-link {
    display: block;
}

 .card {
    background-color: #fff; /* Set a background color */
    border-radius: 10px; /* Rounded corners */
    padding: 20px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }

    .card-title {
        color: #333; /* Title text color */
    }

    .card h6 {
        color: white; /* Subtitle text color */
    }

    .card-icon {
        color: #777; /* Icon color */
    }
    .bg-success {
        background-color: darkslategrey !important;
        padding-top: 1px;
        padding-bottom: 1px;
        border-radius: 4px;
        margin-left: 4px;
        margin-right: 4px;
        margin-top: -13px;
        margin-bottom: 4px;
    }
    .text-muted {
        color: white !important;
    }

   

    .card {
        position: relative;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .card-icon {
        position: absolute;
        top: -5px;
        right: 6px;
        color: white;
    }

    .card-title {
        margin-bottom: 15px;
    }

    h1 {
        font-size: 30px;
        color:white;
    }

     .card-products-sold {
         background: linear-gradient(45deg, #00bcd4, #0097a7);
         transition: background-color 0.3s ease;
    }

   
    .card-products-sold:hover {
   background: linear-gradient(45deg, #0097a7, #00bcd4); /* Change the gradient colors on hover */
    cursor: pointer;
    }
   

    .badge-custom {
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 14px;
        margin-bottom: 5px; /* Add margin bottom for spacing */
    }

    /* CSS for custom hr */
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }


</style>
            <div><h2>🚫SSD Lacking Data
                <div class="badge progress-bar-danger badge-custom" id="badge_id"></div>
                <select name="week_id" id="week_id"  onchange="select_ssd_week_js()">
                        <option value="1">Week 1</option>
                        <option value="2">Week 2</option>
                        <option value="3">Week 3</option>
                        <option value="4">Week 4</option>
                    </select>
            </div>
                <hr class="custom-hr">
            <div id="ssd_lacking_homepage" >
            </div>

<script type="text/javascript">
  select_ssd_week_js();
</script>