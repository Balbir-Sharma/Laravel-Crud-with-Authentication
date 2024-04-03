
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style="float:left;">
                        <h2 class="text-left">Add New Record</h2>
                    </div>
                    <div class="add-button" style="float:right;">
                        <a class="btn btn-dark" href="{{ route('all.records') }}">All Records</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                    <form action="{{ route('store.new.record') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="mb-1">Name : </label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Email :</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Phone :</label>
                                    <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Services:</label>
                                    <select name="services[]" class="form-control" multiple>
                                        <option value="web development" {{ in_array('web development', (array)old('services')) ? 'selected' : '' }}>Web Development</option>
                                        <option value="ui/ux" {{ in_array('ui/ux', (array)old('services')) ? 'selected' : '' }}>UI/UX</option>
                                        <option value="mobile app" {{ in_array('mobile app', (array)old('services')) ? 'selected' : '' }}>Mobile App</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <div class="mb-3">
                                    <label class="mb-1">Country : </label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select Country</option>
                                        <option value="india">India</option>
                                        <option value="nepal">Nepal</option>
                                        <option value="china">China</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Logo : </label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="mb-1">State :</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">City :</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Branch :</label>
                                    <input type="text" name="branch" class="form-control" value="{{ old('branch') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Define states for each country
    const states = {
        india: ["Maharashtra", "Delhi", "Karnataka"],
        nepal: ["Kathmandu", "Pokhara", "Bhaktapur"],
        china: ["Beijing", "Shanghai", "Guangzhou"]
    };

    // Populate the state dropdown based on the selected country
    document.getElementById('country').addEventListener('change', function() {
        const country = this.value;
        const stateDropdown = document.getElementById('state');
        // Clear existing options
        stateDropdown.innerHTML = '<option value="">Select State</option>';
        if (country && states[country]) {
            states[country].forEach(function(state) {
                const option = document.createElement('option');
                option.text = state;
                option.value = state;
                stateDropdown.appendChild(option);
            });
        }
    });

    // Dummy cities data (you can replace with real data if available)
    const cities = {
        Maharashtra: ["Mumbai", "Pune", "Nagpur"],
        Delhi: ["New Delhi", "Noida", "Gurgaon"],
        Karnataka: ["Bangalore", "Mysore", "Hubli"],
        Kathmandu: ["Kathmandu", "Pokhara", "Bhaktapur"],
        Pokhara: ["Pokhara", "Lekhnath", "Sarangkot"],
        Bhaktapur: ["Bhaktapur", "Banepa", "Dhulikhel"],
        Beijing: ["Beijing", "Shijiazhuang", "Tianjin"],
        Shanghai: ["Shanghai", "Hangzhou", "Nanjing"],
        Guangzhou: ["Guangzhou", "Shenzhen", "Dongguan"]
    };

    // Populate the city dropdown based on the selected state
    document.getElementById('state').addEventListener('change', function() {
        const state = this.value;
        const cityDropdown = document.getElementById('city');
        // Clear existing options
        cityDropdown.innerHTML = '<option value="">Select City</option>';
        if (state && cities[state]) {
            cities[state].forEach(function(city) {
                const option = document.createElement('option');
                option.text = city;
                option.value = city;
                cityDropdown.appendChild(option);
            });
        }
    });
</script>

</body>
</html>