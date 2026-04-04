<div class="flex h-[82vh] items-center justify-center">
    <div class="card bg-base-300 min-w-sm max-w-xl shadow-sm">
        <form action="/register" method="post" class="card-body">
            @csrf
            <h2 class="card-title">Step 3</h2>
            <input type="hidden" name="step" value="3">
            <label class="label"><input type="checkbox" checked="checked" class="checkbox mr-2" />
                I agree</label>
            <div class="card-actions justify-between">
                <button type="submit" form="prev" class="btn">Prev</button>
                <button type="submit" class="btn primary">Submit</button>
            </div>

        </form>
    </div>
</div>
<form action="/register" method="post" id="prev">
    @csrf
    <input type="hidden" name="step" value="2">
</form>
