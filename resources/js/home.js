document.addEventListener("DOMContentLoaded", async () => {
    // Listen for request acceptance or decline notification sent to customer
    //   window.Echo.private(`customers.{{Auth::id()}}`)
    // .listen('RequestAcceptedEvent', (e) => {
    // alert(e.message);
    // window.location.href = `/fabric-details-form/${e.request_id}`;
    // })
    // .listen('RequestDeclinedEvent', (e) => {
    // alert(e.message);
    // // Implement further logic for declined request
    // });

    // Listen for hire notification sent to tailor
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const userId = document
        .querySelector('meta[name="user-id"]')
        .getAttribute("content");

    window.Echo.private(`customers.${userId}`)
        .listen("RequestAcceptedEvent", async (e) => {
            console.log(e);
            // store notification

            const storeNotification = {
                user_id: userId,
                request_id: e.request_id,
                message: e.message,
            };

            const store = await http.post(
                "/notifications/store",
                storeNotification,
                csrfToken
            );

            addNotification(store);
        })
        .listen("RequestDeclinedEvent", async (e) => {
            console.log(e.message);
            alert(e.message);
            // Implement further logic for declined request
        });

    // Fetch Tailors
    const searchInput = document.querySelector(".search-input");
    const searchSelect = document.querySelector(".search-select");
    const searchIcon = document.querySelector(".search-icon i");

    searchInput.addEventListener("keyup", async (e) => {
        const shop_name = e.target.value;
        const type = searchSelect.value;

        updateURL(shop_name, type, 1);
        await fetchTailors(shop_name, type);
    });

    searchSelect.addEventListener("change", async (e) => {
        const shop_name = searchInput.value;
        const type = e.target.value;

        console.log(shop_name, type);

        updateURL(shop_name, type, 1);
        await fetchTailors(shop_name, type);
    });

    searchIcon.addEventListener("click", async () => {
        const shop_name = searchInput.value;
        const type = searchSelect.value;

        updateURL(shop_name, type, 1);
        await fetchTailors(shop_name, type);
    });

    async function fetchTailors(shop_name = "", type = "", page = 1) {
        const messageElement = document.querySelector("#message");
        const content = document.querySelector(".content");

        // Clear previous results
        messageElement.textContent = "";
        content.innerHTML = "";

        try {
            const response = await fetch(
                `/tailors/tailor?shop_name=${shop_name}&type=${type}&page=${page}`
            );

            const data = await response.json();

            if (!data.tailors || data.tailors.length === 0) {
                messageElement.textContent = data.message;
                return;
            }

            data.tailors.data.forEach((tailor) => {
                const link = "http://localhost:8000";
                const shop_image = tailor.shop_image
                    ? `${link}/storage/${tailor.shop_image}`
                    : `${link}/storage/images/default_tailor.jpg`;

                content.innerHTML += `
              <a href="/tailor/${tailor.id}">
                <div class="box">
                  <div class="card" id="card" name="card">
                    <div class="pic">
                       <img src=${shop_image} alt="Shop Image">
                    </div>
                    <div class="shopName" name="shopName">${tailor.shop_name}</div>
                    <p name="aboutShop" style="color: aliceblue;">${tailor.bio}</p>
                  </div>
                </div>
              </a>
            `;
            });
        } catch (error) {
            messageElement.textContent =
                "Error fetching users. Please try again later.";
        }
    }

    const getQueryParameter = (param) => {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    };

    const updateURL = (shop_name, type, page) => {
        const url = new URL(window.location.href);
        if (shop_name) {
            url.searchParams.set("shop_name", shop_name);
        } else {
            url.searchParams.delete("shop_name");
        }
        if (type) {
            url.searchParams.set("type", type);
        } else {
            url.searchParams.delete("type");
        }
        if (page) {
            url.searchParams.set("page", page);
        } else {
            url.searchParams.delete("page");
        }
        window.history.pushState({}, "", url);
    };

    // Initial Fetch with Query Parameters
    const initialShopName = getQueryParameter("shop_name") || "";
    const initialType = getQueryParameter("type") || "";
    const initialPage = getQueryParameter("page") || 1;

    searchInput.value = initialShopName;
    searchSelect.value = initialType;

    await fetchTailors(initialShopName, initialType, initialPage);
});
