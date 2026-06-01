
    
    <style>
        /* Style for circular frame */
        .circle-frame {
            position: relative;
            border: 4px solid transparent;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            overflow: hidden; /* Hide image overflow */
            width: 150px;
            height: 150px;
            transition: all 0.3s;
        }
        .circle-frame:hover {
            transform: scale(1.1);
        }

        

        #table_style {
  
  border-radius: 2px;
  box-shadow:
    0px 0px 6px rgba(100, 100, 100, 0.3), /* Adjust the color and spread */
    0px 0px 15px rgba(100, 100, 100, 0.4), /* Adjust the color and spread */
    0px 0px 30px rgba(100, 100, 100, 0.5); /* Adjust the color and spread */
}

.confetti{
   max-width: 1100px;
   display: block;
   margin: 0 auto;
   
   user-select: none;
}


.confetti-container {
    position: relative;
    text-align: center;
}

h1 {
    position: relative;
    z-index: 1;
}

.confetti {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height:100%;
    z-index: 0;
}


* {
  margin: 0;
  padding: 0;
}

.container {
  position: relative;
  width: 1065px;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  transform-style: preserve-3d;
  perspective: 800px;
  margin: auto;
}

.container .box {
  position: relative;
  width: 180px;
  height: 180px;
  transition: 0.5s;
  transform-style: preserve-3d;
  overflow: hidden;
  margin-right: 15px;
  margin-top: 45px;
  border-radius: 50%; /* Make the box circular */
  background: radial-gradient(circle, #4e73df, #8898aa); /* Blue to Gray gradient */
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); /* 3D shadow effect */
  box-sizing: border-box;
}

.container .box:hover {
  transform: rotateY(0deg) scale(1.25);
  z-index: 1;
}

.container .box:hover::before {
  animation: borderAnimation 0.5s forwards;
}

@keyframes borderAnimation {
  from {
    width: 0;
    height: 0;
  }
  to {
    width: 100%;
    height: 100%;
  }
}

.container:hover .box {
  transform: rotateY(1deg);
}

.container .box:hover ~ .box {
  transform: rotateY(-1deg);
}

.container .box .imgBx {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%; /* Make the image circular */
  overflow: hidden;
}

.container .box .imgBx:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, #ffffff, #808080);
  z-index: 1;
  opacity: 0;
  transition: 0.5s;
  mix-blend-mode: multiply;
}

.container .box:hover .imgBx:before {
  opacity: 1;
}

.container .box .imgBx img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.container .box .content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  display: flex;
  padding: 20px;
  align-items: flex-end;
  box-sizing: border-box;
  transform-style: preserve-3d;
}

.container .box .content h2 {
  color: #fff;
  transition: 0.5s;
  margin-bottom: -4px;
  font-size: 18px;
  transform: translateY(200px);
  transition-delay: 0.3s;
}

.container .box:hover .content h2 {
  transform: translateY(0px);
}

.container .box .content p {
  color: #fff;
  transition: 0.5s;
  font-size: 14px;
  margin-bottom: -6px;
  transform: translateY(200px);
  transition-delay: 0.4s;
}

.container .box:hover .content p {
  transform: translateY(0px);
}



    </style>
        <div class="confetti-container">
        <header>
            <h1 ><span style="color:blue; font-size:45px;">🛈</span> About Us</h1>
        </header>
        
                <div class="row" >
                    <div class="col-md-12">
                        <p>
                            Welcome to our organization's About Us page. We are dedicated to providing high-quality services and products to our customers.</br>
                            Our commitment to excellence and customer satisfaction drives everything we do.
                        </p>
                        <!-- <p>
                            At [Your Organization Name], we aim to [describe your mission or purpose]. With a team of passionate and skilled professionals,
                            we have been serving our customers for [number of years] years.
                        </p>

                        <p>
                            Our core values include [list your core values, e.g., quality, integrity, customer satisfaction], and we uphold these values in every aspect of our business.
                        </p> -->
                        <p>
                            Please explore our website to learn more about our products, services, and the team behind our success. If you have any questions or inquiries,
                            feel free to contact us.</br> We look forward to serving you and building a lasting relationship.
                        </p>
                    </div>
                </div>
           

        <header>
            <h1 class="mt-4">📱 Contact Us</h1>
        </header>

        <div class="row mt-4" >
                <div class="col-md-12">
                    <p >
                        If you have any questions or would like to get in touch with us, please feel free to contact us using the details below.
                    </p>
                </div>
                    
                        <div class="col-md-4">
                            <h5>📍&nbsp;Location</h5>
                            <p>
                                Upper Ground, North Wing, Island City Mall, Tagbilaran City, Bohol, Philippines 6300
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5>📞&nbsp;Call Us</h5>
                            <p>
                                Phone: 1821 - EBM/GO<br>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1844 - HRMS,CMS,PMS
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h5>📬&nbsp;Email</h5>
                            <p>
                                itsysdevteamebm@gmail.com
                            </p>     
                        </div>
                    
                </div>

        <div class="container-fluid">
    <div style="text-align:center;">
        <h1>
            👨‍👨‍👦‍👦 Our Team
        </h1>
    </div>

    <div class="row mt-4">
    <!-- <div class="col-md-3">
        <div class="circle-frame">
            <div class="square-frame">
                <img src="assets/store_logo/talibon.png" alt="Image 1" class="img-fluid">
                <div class="image-details">
                    <label>dfdfdff</label>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-md-3">
        <div class="circle-frame">
            <div class="square-frame">
                <img src="../../../hrms/<?php echo explode("../", $profile['photo'])[1]; ?>" alt="Profile Photo" class="img-fluid">
                <div class="image-details">
                    <label>dfdfdff</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="circle-frame">
            <div class="square-frame">
                <img src="assets/store_logo/talibon.png" alt="Image 1" class="img-fluid">
                <div class="image-details">
                    <label>dfdfdff</label>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="circle-frame">
            <div class="square-frame">
                <img src="assets/store_logo/talibon.png" alt="Image 1" class="img-fluid">
                <div class="image-details">
                    <label>dfdfdff</label>
                </div>
            </div>
        </div>
    </div> -->

<div class="container">
    <div class="box">
         <div class="imgBx">
            <img src="../../../hrms/<?php echo explode("../", $profile['photo'])[1]; ?>" alt="Profile Photo" class="img-fluid">
         </div>

         <div class="content">
            <div>
                <h2>Renciomar Dano</h2>
                <p>Programmer</p>
            </div>
         </div>
    </div>
  <div class="box">
    <div class="imgBx">
      <img src="https://images.unsplash.com/photo-1579639782539-15cc6c0be63f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80">
    </div>
    <div class="content">
      <div>
        <h2>Image Title</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusamus molestias quidem iusto.
        </p>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="imgBx">
      <img src="https://images.unsplash.com/photo-1603984362497-0a878f607b92?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80">
    </div>
    <div class="content">
      <div>
        <h2>Image Title</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusamus molestias quidem iusto.
        </p>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="imgBx">
      <img src="https://images.unsplash.com/photo-1579310962131-aa21f240d986?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1234&q=80">
    </div>
    <div class="content">
      <div>
        <h2>Image Title</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusamus molestias quidem iusto.
        </p>
      </div>
    </div>
  </div>

<canvas class="confetti" id="canvas"></canvas>

</div>
</div>

    </div>
</div>
</main>
<!-- <script src="<?php echo base_url('assets/js/confetti.js'); ?>"></script> -->
