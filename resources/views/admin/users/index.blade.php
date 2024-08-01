@extends('layouts.app')

@section('title')
Users
@endsection

@push('style')
<style>
  table {
    margin: 10px;
    padding: 10px;
    font-size: 1.5rem;
  }

  tbody tr:nth-of-type(even) {
    background-color: rgb(214, 200, 195);
  }

  a {
    text-decoration: none;
  }

  button {
    cursor: pointer;
  }

  /* Pagination */
  nav .w-5 {
    display: none;
  }

  .paginator {
    width: 50%;
  }

  .container {
    display: grid;
    place-items: center;
    padding: 10px;
    gap: 20px;
  }

</style>
@endpush

@section('content')

<div class="container">
  <div class="nav-search">
    <select name="" class="search-select">
      <option value="">All</option>
      <option value="customer">Customer</option>
      <option value="tailor">Tailor</option>
    </select>
    <input type="text" placeholder="Search" class="search-input">
    <div class="search-icon">
      <i class="fa-solid fa-magnifying-glass"></i>
    </div>
  </div>

  <div>
    <a href="{{ route('admin.index') }}"><button>Back</button></a>
    <a href="{{ route('users.create') }}"><button>Create User</button></a>
  </div>

  <div id="message"></div>

  <div id="userTableContainer">
    <table>
      <thead>
        <tr>
          <th>SI</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody id="userTable">
        {{-- dynamic content --}}
      </tbody>
    </table>

    <div id="pagination"></div>
  </div>
</div>
@endsection
ll
@push('script')
<script>
  document.addEventListener('DOMContentLoaded', async () => {
    const searchInput = document.querySelector(".search-input");
    const searchSelect = document.querySelector('.search-select');
    const searchIcon = document.querySelector('.search-icon i');

    searchInput.addEventListener("keyup", async (e) => {
      const name = e.target.value;
      const role = searchSelect.value;

      updateURL(name, role, 1);
      await fetchUsers(name, role);
    });

    searchSelect.addEventListener("change", async (e) => {
      const name = searchInput.value;
      const role = e.target.value;

      updateURL(name, role, 1);
      await fetchUsers(name, role);
    });

    searchIcon.addEventListener("click", async () => {
      const name = searchInput.value;
      const role = searchSelect.value;

      updateURL(name, role, 1);
      await fetchUsers(name, role);
    });

    async function fetchUsers(name = '', role = '', page = 1) {
      const messageElement = document.getElementById('message');
      const userTable = document.getElementById('userTable');
      const userTableHead = userTable.previousElementSibling;
      const paginationElement = document.getElementById('pagination');

      // Clear previous results
      messageElement.textContent = '';
      userTable.innerHTML = '';
      paginationElement.innerHTML = '';
      userTableHead.style.display = 'none';

      try {
        const response = await fetch(`/users/user?name=${name}&role=${role}&page=${page}`);

        const data = await response.json();

        if (!data.users || data.users.length === 0) {
          messageElement.textContent = data.message;
          return;
        }

        data.users.data.forEach((user, index) => {
          userTable.innerHTML += `
         <tr>
          <td>${data.users.from + index}</td>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.phone}</td>
          <td><a href="/users/${user.id}"><button class="button">View</button></a></td>
          <td><a href="/users/${user.id}/edit"><button class="button">Update</button></a></td>
          <td>
            <form action="/users/${user.id}" method="POST" id="delete-form">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="button">Delete</button>
            </form>
          </td>
          </tr>
          `;
        });
        userTableHead.style.display = '';

        paginationElement.innerHTML = `${data.pagination}`;

        paginationElement.querySelectorAll('a').forEach(link => {
          if (link.textContent == data.current_page) {
            link.parentElement.classList.add('active');
          } else {
            link.parentElement.classList.remove('active');
          }

          link.addEventListener('click', (event) => {
            event.preventDefault();
            const url = new URL(link.href);
            const page = url.searchParams.get('page');

            updateURL(name, role, page);
            fetchUsers(name, role, page);
          });
        });

      } catch (error) {
        messageElement.textContent = 'Error fetching users. Please try again later.';
      }
    }

    const getQueryParameter = (param) => {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(param);
    };

    const updateURL = (name, role, page) => {
      const url = new URL(window.location.href);
      if (name) {
        url.searchParams.set('name', name);
      } else {
        url.searchParams.delete('name');
      }
      if (role) {
        url.searchParams.set('role', role);
      } else {
        url.searchParams.delete('role');
      }
      if (page) {
        url.searchParams.set('page', page);
      } else {
        url.searchParams.delete('page');
      }
      window.history.pushState({}, '', url);
    };

    // Initial Fetch with Query Parameters
    const initialName = getQueryParameter('name') || '';
    const initialRole = getQueryParameter('role') || '';
    const initialPage = getQueryParameter('page') || 1;

    searchInput.value = initialName;
    searchSelect.value = initialRole;
    await fetchUsers(initialName, initialRole, initialPage);
  });



  // Not working
  //   const form = document.getElementById("delete-form");

  //   const csrfToken = document
  //     .querySelector('meta[name="csrf-token"]')
  //     .getAttribute("content");
  //   const formAction = form.action;

  //   form.addEventListener("submit", function(event) {
  //     event.preventDefault(); // Prevent the form from submitting the traditional way
  //     console.log(formAction);
  //     deleteAccount();
  //   });

  //   async function deleteAccount() {
  //     const response = await fetch(deleteForm.action, {
  //       method: DELETE
  //       , headers: {
  //         "XSRF-TOKEN": csrfToken
  //       , }
  //     , });

  //     const data = await response.json();
  //     if (!data) {
  //       alert(data.error);
  //     }
  //     alert(data.status);
  //   }

</script>
@endpush
