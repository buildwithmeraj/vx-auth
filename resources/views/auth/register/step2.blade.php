<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 w-sm md:w-md shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="text-center font-bold text-2xl">Register</h2>
            <div class="flex justify-center -mt-7 mb-2">
                <x-registration-steps></x-registration-steps>
            </div>
            <input type="hidden" name="step" value="3">
            <div>
                <label for="gender">Gender</label>
                <select class="select w-full" name="gender" id="gender" required>
                    <option value="male" {{ ($data['gender'] ?? '') === "male" ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ ($data['gender'] ?? '') === "female" ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ ($data['gender'] ?? '') === "other" ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="phone">Phone</label>
                <input type="tel" placeholder="+8801XXXXXXXXX" name="phone" class="input w-full"
                       value="{{ $data['phone'] ?? '' }}" id="phone" required />
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" placeholder="Dhaka-1201, Bangladesh" name="address" class="input w-full"
                       value="{{ $data['address'] ?? '' }}" id="address" required />
            </div>
            <div class="card-actions justify-between mt-2">
                <button type="submit" form="prev" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                    Previous
                </button>
                <button type="submit" class="btn">Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>


<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="1">
</form>

