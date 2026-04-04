<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 min-w-sm max-w-xl shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="card-title">Step 2</h2>
            <input type="hidden" name="step" value="3">
            <div>
                <label for="gender">Gender</label>
                <select class="select" name="gender">
                    <option value="male" {{ $data['gender'] === "male" ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $data['gender'] === "female" ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $data['gender'] === "other" ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="tel" placeholder="+8801XXXXXXXXX" name="phone" class="input"
                       value="{{ $data['phone'] ?? '' }}" />
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" placeholder="Dhaka-1201, Bangladesh" name="address" class="input"
                       value="{{ $data['address'] ?? '' }}" required />
            </div>
            <div class="card-actions justify-between">
                <button type="submit" form="prev" class="btn">Prev</button>
                <button type="submit" class="btn">Next</button>
            </div>

        </form>
    </div>
</div>


<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="1">
</form>

