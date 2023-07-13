<div class="card w-full h-fit bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">Profile</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-2">
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Username</span>
                </label>
                <input type="text" id="username" name="username" placeholder="Type here" class="input input-bordered w-full max-w-xs" />

            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">About</span>
                </label>
                <textarea class="textarea textarea-bordered" id="about" name="about" placeholder="About"></textarea>

            </div>
            <div class="form-control w-full max-w-xs">
                <label class="label">
                    <span class="label-text">Photo</span>
                </label>
                <input type="file" name="photo" id="photo" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />

            </div>


        </div>


        <div class="card-actions justify-end">
            <button class="btn btn-primary">Buy Now</button>
        </div>
    </div>
</div>
