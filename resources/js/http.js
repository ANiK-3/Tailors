class HTTP {
    // Make an HTTP GET Request
    async get(url) {
        try {
            const response = await fetch(url);
            // if (!response.ok) {
            //     throw new Error(
            //         `GET request failed with status ${response.status}`
            //     );
            // }
            const responseData = await response.json();
            return responseData;
        } catch (error) {
            alert(error.message);
            // throw error;
        }
    }

    // Make an HTTP POST Request
    async post(url, data, csrfToken) {
        return this.sendRequest("POST", url, data, csrfToken);
    }

    // Make an HTTP PUT Request
    async put(url, data, csrfToken) {
        return this.sendRequest("PUT", url, data, csrfToken);
    }

    // Make an HTTP DELETE Request
    async delete(url, data, csrfToken) {
        return this.sendRequest("DELETE", url, data, csrfToken);
    }

    async sendRequest(method, url, data, csrfToken) {
        try {
            let headers = { "X-CSRF-TOKEN": csrfToken };
            let body;

            if (data instanceof FormData) {
                body = data; // if form data
            } else {
                headers["Content-Type"] = "application/json";
                body = JSON.stringify(data);
            }

            const response = await fetch(url, {
                method: method,
                headers: headers,
                body: body,
            });

            // if (!response.ok) {
            //     throw new Error(
            //         `${method} request failed with status ${response.status}`
            //     );
            // }

            const responseData = await response.json();
            return responseData;
        } catch (error) {
            alert(error.message);
            // throw error;
        }
    }
}

// Make HTTP class globally available
window.http = new HTTP();
