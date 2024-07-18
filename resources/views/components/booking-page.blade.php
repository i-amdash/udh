<div class="min-h-screen"
    style="background-image:url({{ asset('assets/Watermark.png') }}); background-size: cover; background-repeat: no-repeat;">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            {{ $header }}
        </div>
    </div>
    <div>
        {{ $body }}
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('contentChanged', (e) => {
            alert(e.message);
        });

        document.addEventListener('livewire:initialized', () => {
            @this.on('swal', (event) => {
                alert(event.message);
            });
        });
    </script>
@endpush
