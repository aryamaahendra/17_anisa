import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

import * as FilePond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageTransform from "filepond-plugin-image-transform";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImageResize from "filepond-plugin-image-resize";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginImageTransform);
FilePond.registerPlugin(FilePondPluginImageCrop);
FilePond.registerPlugin(FilePondPluginImageResize);

const csrf = document.querySelector('meta[name="csrf-token"]').content;
const base_url = import.meta.env.VITE_BASE_URL;

document.addEventListener("DOMContentLoaded", () => {
    const flashMsgError = document.getElementById("flash-message-error");
    const flashMsgMessage = document.getElementById("flash-message-message");

    if (flashMsgError && flashMsgMessage) {
        Swal.fire({
            icon: flashMsgError.value ? "error" : "success",
            title: flashMsgError.value ? "error" : "success",
            text: flashMsgMessage.value,
            showConfirmButton: false,
            timer: 1500,
        });
    }

    Alpine.start();
});

Alpine.data("confirmDeleteModal", () => ({
    async showModal() {
        const result = await Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        });

        if (result.isConfirmed) {
            this.$root.submit();
        }
    },
}));

Alpine.data("dataFormImgs", () => ({
    init() {
        const pond = FilePond.create(this.$refs.input, {
            imageCropAspectRatio: "1:1",
            imageResizeTargetWidth: 255,
            imageResizeTargetHeight: 255,
            server: {
                url: `${base_url}/upload/file?m=data`,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                    Accept: "application/json",
                },
            },
        });
    },
}));

Alpine.data("KNNDashboard", () => ({
    init() {
        const pond = FilePond.create(this.$refs.input, {
            imageCropAspectRatio: "1:1",
            imageResizeTargetWidth: 255,
            imageResizeTargetHeight: 255,
            imagePreviewHeight: 180,
            server: {
                url: `${base_url}/dashboard/knn`,
                process: {
                    onload: (res) => {
                        const response = JSON.parse(res);
                        Livewire.emitTo(
                            "knn-dashboard",
                            "setProcess",
                            response.data
                        );
                    },
                },
                revert: null,
                load: null,
                restore: null,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                    Accept: "application/json",
                },
            },
        });
    },
}));
