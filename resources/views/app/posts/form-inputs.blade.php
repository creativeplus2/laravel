@php $editing = isset($post) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $post->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.text
            name="title"
            label="Title"
            value="{{ old('title', ($editing ? $post->title : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <x-inputs.textarea
            name="content"
            label="Content"
            maxlength="255"
            required
            >{{ old('content', ($editing ? $post->content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-md-12 col-lg-12">
        <div x-data="ImageComponentData()">
            <label for="Image">Image</label><br />

            <img
                :src="ImageDataUrl"
                style="object-fit: cover; width: 150px; height: 150px; border: 1px solid #ccc;"
            /><br />

            <div class="mt-2">
                <input
                    type="file"
                    name="Image"
                    id="Image"
                    @change="fileChanged"
                />
            </div>

            @error('Image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </x-inputs.group>
</div>

@push('scripts')
<script>

    /* Alpine component for Image uploader viewer */
    function ImageComponentData() {
        return {
            ImageDataUrl: '{{ $editing && $post->Image ? \Storage::url($post->Image) : '' }}',

            fileChanged(event) {
                fileToDataUrl(event, src => this.ImageDataUrl = src)
            }
        }
    }
</script>
@endpush
