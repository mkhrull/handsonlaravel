<nav class="navbar" style="background-color: #6f42c1;">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand" style="color: #fff;" href="{{ route('admindashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100" height="40" class="d-inline-block align-text-top">
            HandsOn Dashboard
        </a>
        <div class="d-flex align-items-center">
            <div class="form-check form-switch mx-4">
                <input
                    class="form-check-input p-2"
                    type="checkbox"
                    role="switch"
                    id="flexSwitchCheckChecked"
                    onclick="myFunction()"
                />
                <label class="form-check-label text-white ms-2" for="flexSwitchCheckChecked">Dark Mode</label>
                <script>
                    function myFunction() {
                        var element = document.body;
                        var theme = element.dataset.bsTheme === "dark" ? "light" : "dark";
                        element.dataset.bsTheme = theme;
                        localStorage.setItem('theme', theme);
                        updateCheckboxState(theme);
                    }

                    function updateCheckboxState(theme) {
                        var checkbox = document.getElementById('flexSwitchCheckChecked');
                        checkbox.checked = theme === 'dark';
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        var theme = localStorage.getItem('theme');
                        if (theme) {
                            document.body.dataset.bsTheme = theme;
                            updateCheckboxState(theme);
                        }
                    });
                </script>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>