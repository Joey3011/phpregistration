</div>
<footer>
    <p>Copyright 2022, Email: joey.hipolito30@gmail.com</p>
    <div>
        <a href="https://github.com/Joey3011/">
          <i class="fa fa-github" aria-hidden="true"></i>
        </a> 
        <a href="https://www.linkedin.com/in/joey-h-22882324a">
          <i class="fa fa-linkedin" aria-hidden="true"></i>
       </a>
        <a href="https://www.facebook.com/joey30.hipolito">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
    </div>
</footer>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '.joey', function(){
      $('#emailme').modal().show();
         var name = $('#emailme').find('#name').val();
          var  senderEmail = $('#emailme').find('#senderEmail').val();
          var  newMessage = $('#emailme').find('#Emailmsg').val();
    if(name != "" && senderEmail!= "" && newMessage != ""){
      $('#SendEmail').click(function(){
      if(confirm('Proceed sending email to Joey?')){
        $.ajax({
          url: "/../myPage/sendEmail",
          type: "POST",
          data: {

          },
          cache: false,
          success: function(data){
            console.log(data);
            var dataResult = JSON.parse(data);
            if(dataResult.statusCode == 200){
                $('#add_One').find('input:text').val('');
                $('#add_One').find('textarea').val('');
                alert("Email sent!");
              alert("Email sent!");
                $('#emailme').modal().hide();
            }else if(dataResult.statusCode == 201){
              alert("Failed to connect to mailserver");
            }
          }
        });
      }
    });
  }else{
    alert("All field are required");
  }
      $('#closeEmail').click(function(){
        $('#emailme').modal().hide();
      });
      $('.exit').click(function(){
        $('#emailme').modal().hide();
      });
    });
  });
</script>
<script type="text/javascript">
    let navbar = document.querySelector(".navbar");
    let navLinks = document.querySelector(".nav-links");
    let menuOpenBtn = document.querySelector(".navbar .fa-bars");
    let menuCloseBtn = document.querySelector(".nav-links .fa-close");
      menuOpenBtn.onclick = function() {
        navLinks.style.left = "0";
      }
      menuCloseBtn.onclick = function() {
        navLinks.style.left = "-100%";
      }

      // sidebar submenu open close js code
    let projArrow = document.querySelector(".proj-arrow");
    projArrow.onclick = function() {
        navLinks.classList.toggle("show");
    }
</script>
</body>
</html>