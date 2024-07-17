$(document).ready(function () {
    $(".view-product-btn").on("click", function () {
        var productId = $(this).data("id");
        var productName = $(this).data("name");
        var productPrice = $(this).data("price");
        var productDescription = $(this).data("description");
        var productLink = $(this).data("link");
        var productImages = $(this).data("image");

        $("#modalProductName").text(productName);
        $("#modalProductPrice").text(productPrice);
        $("#modalProductDescription").text(productDescription);
        $("#modalProductLink").attr("href", productLink);

        const modalCarouselInner = $("#modalCarouselInner");
        modalCarouselInner.empty();

        if (Array.isArray(productImages) && productImages.length > 0) {
            productImages.forEach((item, index) => {
                const carouselItem = document.createElement("div");
                carouselItem.className = `carousel-item ${
                    index === 0 ? "active" : ""
                }`;
                carouselItem.innerHTML = `<img src="${imageBaseUrl}/${item}" class="d-block w-100 img-fluid" style="border-radius: 10px; max-height: 450px;" alt="Product Image">`;
                modalCarouselInner.append(carouselItem);
            });
        } else {
            const noImageItem = document.createElement("div");
            noImageItem.className = "carousel-item active";
            noImageItem.innerHTML = "<p>No images available</p>";
            modalCarouselInner.append(noImageItem);
        }

        $("#productModal").modal("show");
    });
});
