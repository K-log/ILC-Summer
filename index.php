<?php require_once( "SNIPPETS/HEADER.php" ); ?>

<div class="jumbotron jumbotron-fluid" id="HomeSection">
  <h1 class="display-3 jumbotronTextOnImages text-center" id="JumbotronHeading">Heading</h1>

  <img id="JumbotronImage" src="https://res.cloudinary.com/sonarsystems/image/upload/v1497973720/Youtube_2Bnew_2Bheader_u0ruil.png" />
</div>
<div class="container-fluid" id="TeamSection">
  <div class="row">
    <div class="col-12 text-center">
      <h1>Our Awsome Team</h1>
        <p>This is a great description of some awesome team we may or may not have!</p>
    </div>
  </div>
  <div class="row text-center">
    <div class="col-lg-3 col-sm-6 col-xs-12 teamMemberContainer">
      <img src="Images/Team/Thumbnails/Thumbnail.png" class="img-fluid img-thumbnail teamMemberImage" />
      <h4>Person 1</h4>
      <p class="text-muted">Leader</p></p>
      <p>This person leads the team.</p>
      
      <div class="col-12">
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
        </a>
        
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
        </a>

        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12 teamMemberContainer">
      <img src="Images/Team/Thumbnails/Thumbnail.png" class="img-fluid img-thumbnail teamMemberImage" />
      <h4>Person 2</h4>
      <p class="text-muted">Coder</p></p>
      <p>Made this web page...</p>
      
      <div class="col-12">
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
        </a>
        
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
        </a>

        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12 teamMemberContainer">
      <img src="Images/Team/Thumbnails/Thumbnail.png" class="img-fluid img-thumbnail teamMemberImage" />
      <h4>Person 3</h4>
      <p class="text-muted">Manager?</p></p>
      <p>This person Manages the team.</p>
      
      <div class="col-12">
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
        </a>
        
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
        </a>

        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-xs-12 teamMemberContainer">
      <img src="Images/Team/Thumbnails/Thumbnail.png" class="img-fluid img-thumbnail teamMemberImage" />
      <h4>Person 4</h4>
      <p class="text-muted">Pianist</p></p>
      <p>Provides good music</p>
      
      <div class="col-12">
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
        </a>
        
        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
        </a>

        <a href="" target="_blank">
            <img class="socialImages" src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
        </a>
      </div>
    </div>  
  </div>
  <div class="container-fluid" id="ContactSection">
    <div class="row">
      <div class="col-12 text-center">
        <h1>Contact Us</h1>
      </div>
    </div>

    <form>
      <div class="row">

        <div class="col-md-6">
          <label for="contactEmail">Email address</label>
          <input type="email" class="form-control" id="contactEmail" placeholder="Enter email address">
          <small class="form-text">We'll mever share your email with anyone else.</small>
        </div>

        <div class="col-md-6">
          <label for="contactName">Name</label>
          <input type="text" class="form-control" id="contactName" placeholder="Enter your Name">
        </div>

        <div class="col-12">
          <label for="contactName">Message</label>
          <textarea class="form-control" id="contactMessage" rows="5"></textarea>
        </div>

        <div class="col-12" id="ContactButtonContainer">
          <button type="Submit" class="btn btn-primary col-12">Send Message</button>
        </div>

      </div>
    </form>
  </div>
</div>

<?php require_once( "SNIPPETS/FOOTER.php" ); ?>