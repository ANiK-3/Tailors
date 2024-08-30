<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
</head>
<body>
  <h1>ID: {{Auth::id()}}</h1>
  <p>Hello World</p>

  <div id="display-data"></div>

  {{-- @vite('resources/js/app.js') --}}
</body>
<script src="{{mix('js/app.js')}}"></script>
<script>
  setTimeout(() => {
    window.Echo.private('users.{{auth()->id()}}').listen('SendHireNotification', (e) => {
      console.log(e);
    });
  }, 200);
  // setTimeout(() => {
  //   window.Echo.channel('chat').listen('SendNotification', (e) => {
  //     console.log(e)
  //   });
  // }, 200);
  // setTimeout(() => {
  //   window.Echo.channel('public-channel').listen('SendNotification', (e) => {
  //     // alert(e.message.name);
  //     var newParagraph = document.createElement('p');
  //
  //     // Set the text content of the paragraph
  //     newParagraph.textContent = e.message.name;
  //
  //     // Append the paragraph to the container div
  //     var container = document.getElementById('container');
  //     container.appendChild(newParagraph);
  //   });
  // }, 100);
  // let id = 3;
  // const display = document.querySelector("#display-data");
  // document.addEventListener('DOMContentLoaded', () => {
  //   window.Echo.private('private-hire.user.{{Auth::id()}}').listen('SendHireNotification', async (e) => {

  //     const handleEvent = async (data) => {
  //       try {
  //         const {
  //           id
  //           , name
  //           , email
  //         } = data;
  //         return `
  //        <div class="container">
  //           <p>Name: ${name}</p>
  //           <p>Email: ${email}</p>
  //           <a href="http://localhost:8000/user/${id}">Click</a>
  //        </div>
  //        `
  //         // Example of an asynchronous operation (e.g., fetching additional data)
  //         // const response = await fetch(`https://api.example.com/data/${message.id}`);
  //         // const additionalData = await response.json();

  //         // Create a new paragraph element
  //         // var newParagraph = document.createElement('p');
  //         //
  //         // // Set the text content of the paragraph
  //         // newParagraph.textContent = data.name; // Use additionalData if needed
  //         //
  //         // // Append the paragraph to the container div
  //         // var container = document.getElementById('container');
  //         // container.appendChild(newParagraph);
  //       } catch (error) {
  //         console.error('Error handling event:', error);
  //       }
  //     };

  //     display.innerHTML += await handleEvent(e.data);
  //   });
  // });

</script>
</html>
