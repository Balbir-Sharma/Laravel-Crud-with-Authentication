<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel crud</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style="float:left;">
                        <h2 class="text-left">Edit Record</h2>
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

                    <form action="{{ route('update.record',$record->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="mb-1">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $record->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $record->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Mobile :</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $record->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Services:</label>
                                    <select name="services[]" class="form-control" multiple>
                                        <option value="web development" {{ in_array('web development', explode(', ', $record->services)) ? 'selected' : '' }}>Web Development</option>
                                        <option value="ui/ux" {{ in_array('ui/ux', explode(', ', $record->services)) ? 'selected' : '' }}>UI/UX</option>
                                        <option value="mobile app" {{ in_array('mobile app', explode(', ', $record->services)) ? 'selected' : '' }}>Mobile App</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="mb-1">Country :</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select Country</option>
                                        <option value="india" {{ $record->country == 'india' ? 'selected' : '' }}>India</option>
                                        <option value="nepal" {{ $record->country == 'nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="china" {{ $record->country == 'china' ? 'selected' : '' }}>China</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="stateDiv" style="{{ $record->country ? '' : 'display:none' }}">
                                    <label class="mb-1">State : </label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">Select State</option>
                                        @if($record->state)
                                            <option value="{{ $record->state }}" selected>{{ $record->state }}</option>
                                        @endif
                                    </select>
                                </div>
                                
                                <div class="mb-3" id="cityDiv" style="{{ $record->state ? '' : 'display:none' }}">
                                    <label class="mb-1">City :</label>
                                    <select name="city" id="city" class="form-control">
                                        <option value="">Select City</option>
                                        @if($record->city)
                                            <option value="{{ $record->city }}" selected>{{ $record->city }}</option>
                                        @endif
                                    </select>
                                </div>
                                
                              
                              
                                <div class="mb-3">
                                    <label class="mb-1">Branch :</label>
                                    <input type="text" name="branch" class="form-control" value="{{ $record->branch }}">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <div class="mb-3">
                                    <label class="mb-1">Logo</label>
                                    <img src="{{ asset('images/profile/'.$record->image) }}" style="width:100px;margin-bottom:3px">
                                    @if ($record->image)
                                        <!-- Only show the input field if the record already has an image -->
                                        <input type="file" name="image" class="form-control">
                                        <!-- Add a hidden input field to store the existing image path -->
                                        <input type="hidden" name="old_image" value="{{ $record->image }}">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
        const stateDiv = document.getElementById('stateDiv');
        const cityDiv = document.getElementById('cityDiv');

        // Clear existing options
        stateDropdown.innerHTML = '<option value="">Select State</option>';
        if (country && states[country]) {
            states[country].forEach(function(state) {
                const option = document.createElement('option');
                option.text = state;
                option.value = state;
                stateDropdown.appendChild(option);
            });
            stateDiv.style.display = '';
            cityDiv.style.display = 'none';
        } else {
            stateDiv.style.display = 'none';
            cityDiv.style.display = 'none';
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
        const cityDiv = document.getElementById('cityDiv');

        // Clear existing options
        cityDropdown.innerHTML = '<option value="">Select City</option>';
        if (state && cities[state]) {
            cities[state].forEach(function(city) {
                const option = document.createElement('option');
                option.text = city;
                option.value = city;
                cityDropdown.appendChild(option);
            });
            cityDiv.style.display = '';
        } else {
            cityDiv.style.display = 'none';
        }
    });
</script>

</body>
</html>
