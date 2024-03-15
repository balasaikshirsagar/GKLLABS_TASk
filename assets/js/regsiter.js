if (localStorage.getItem("token")) {
  location.href = "./dashboard.html";
}

function register() {
  let name = $("#name").val();
  let email = $("#email").val();
  let age = $("#age").val();
  let dob = $("#dob").val();
  let password = $("#password").val();

 

  $.ajax({
      url: "./api/register.php",
      method: "POST",
      data: {
          name,
          email,
          age,
          dob,
          password
      },
      success: (response) => {
          response = JSON.parse(response);
          if (!response.status) {
              alert(response.message);
              return false;
          }
          location.href = "./login.html";
      },
      error: (response) => {
          console.log(response);
      },
  });
}