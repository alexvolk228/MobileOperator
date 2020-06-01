
var link = document.querySelector(".login-link");

        var popup = document.querySelector(".modal-login");
        var close = popup.querySelector(".modal-close");

        var form = popup.querySelector("form");
        var login = popup.querySelector("[name=login]");
        var password = popup.querySelector("[name=pass]");

        var isStorageSupport = true;
        var storage = "";

        try {
            storage = localStorage.getItem("login");
        } catch (err) {
            isStorageSupport = false;
        }

        function validate () {
            if (login.value == "") {
                login.classList.remove("modal-error");
                login.classList.add("modal-error");
                return false;
            }
            if (password.value == "") {
                password.classList.remove("modal-error");
                password.classList.add("modal-error");
                return false;
            }
        }

        link.addEventListener("click", function (evt) {
            evt.preventDefault();
            popup.classList.add("modal-show");
       
            if (storage) {
                login.value = storage;
                password.focus();
            } else {
                login.focus();
            }
        });

        close.addEventListener("click", function (evt) {
            evt.preventDefault();
            popup.classList.remove("modal-show");
            login.classList.remove("modal-error");
            password.classList.remove("modal-error");
        });

      

        window.addEventListener("keydown", function (evt) {
            if (evt.keyCode === 27) {
                evt.preventDefault();
                if (popup.classList.contains("modal-show")) {
                    login.classList.remove("modal-error");
                    password.classList.remove("modal-error");
                }
            }
        });