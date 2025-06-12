import { useState } from "react";
import DOMPurify from "dompurify";
import "../../assets/css/product.css";
import { Container, Modal } from "react-bootstrap";
import { Link, useLocation, useParams } from "react-router-dom";

const Product = () => {
  const { slug } = useParams();
  const location = useLocation();
  const { product } = location.state;

  const [showModal, setShowModal] = useState(false);
  const [activeVariant, setActiveVariant] = useState(null);

  const [activeFile, setActiveFile] = useState(
    product.files.find((file) => file.type === "video") ||
      product.files.find((file) => file.thumbnail) ||
      product.files[0]
  );

  const [activeMedia, setActiveMedia] = useState({
    type: activeVariant ? "image" : activeFile.type,
    path: activeVariant ? activeVariant.image : activeFile.path,
  });

  const handleFileClick = (file) => {
    setActiveVariant(null);
    setActiveFile(file);
  };

  const handleFileHover = (file) => {
    setActiveVariant(null);
    setActiveFile(file);
  };

  const handleVariantClick = (variant) => {
    setActiveVariant(variant);
  };

  const handleVariantHover = (variant) => {
    setActiveVariant(variant);
  };

  console.log(slug);

  return (
    <main id="product">
      <Container>
        {/* BreadCrumbs */}
        <div className="d-flex justify-content-start align-items-center gap-2 mt-3 breadcrumb-custom">
          <Link
            to="/"
            className="text-decoration-none"
            style={{ color: "#f5596c" }}
          >
            <small>Home</small>
          </Link>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8">
            <path d="M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z" fill="#6c757d" />
          </svg>
          <Link
            to="/catalog"
            className="text-decoration-none"
            style={{ color: "#f5596c" }}
          >
            <small>Catalog</small>
          </Link>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8">
            <path d="M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z" fill="#6c757d" />
          </svg>
          <small className="text-dark">{product.name}</small>
        </div>

        <div className="row g-4 mt-3">
          <div className="col-12 col-lg-5">
            {/* Thumbnail */}
            <div
              className="thumbnail-wrapper rounded-3 overflow-hidden mb-2 ratio ratio-1x1"
              onClick={() => {
                setShowModal(true);
                setActiveMedia({
                  type: activeVariant ? "image" : activeFile.type,
                  path: activeVariant ? activeVariant.image : activeFile.path,
                });
              }}
            >
              {activeVariant ? (
                <img src={activeVariant.image} alt="Product Thumbnail" />
              ) : activeFile.type === "video" ? (
                <video autoPlay muted loop playsInline src={activeFile.path}>
                  Your browser does not support the video tag.
                </video>
              ) : (
                <img src={activeFile.path} alt="Product Thumbnail" />
              )}
            </div>

            {/* Video & Images */}
            <div
              className="overflow-x-auto w-100 d-flex"
              style={{ scrollbarWidth: "none" }}
            >
              {product.files
                .sort((a, b) => {
                  if (a.type === "video" && b.type !== "video") return -1;
                  if (a.type !== "video" && b.type === "video") return 1;
                  return 0;
                })
                .map((file, index) => (
                  <div
                    className="image-box position-relative"
                    key={index}
                    onClick={() => handleFileClick(file)}
                    onMouseEnter={() => handleFileHover(file)}
                  >
                    {file.type === "image" ? (
                      <img
                        src={file.path}
                        alt="Product Image"
                        className={activeFile === file ? "active" : ""}
                      />
                    ) : (
                      <>
                        <video
                          poster={file.thumbnail ? file.path : undefined}
                          className={activeFile === file ? "active" : ""}
                        >
                          <source src={file.path} type="video/mp4" />
                          Your browser does not support the video tag.
                        </video>

                        <div
                          className="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center"
                          style={{ borderRadius: "8px" }}
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="32"
                            height="32"
                            fill="currentColor"
                            className="bi bi-play-circle"
                            viewBox="0 0 16 16"
                          >
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445" />
                          </svg>
                        </div>
                      </>
                    )}
                  </div>
                ))}
            </div>
          </div>

          <div className="col-12 col-lg-7">
            {/* Name */}
            <h6 className="product-name mb-3">{product.name}</h6>

            {/* Price */}
            <h6 className="product-price" style={{ marginBottom: "2rem" }}>
              {new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0,
              }).format(product.price)}
            </h6>

            {/* Bahan */}
            {product.material && (
              <div className="d-flex justify-content-start align-items-start mb-4">
                <h6 className="mb-0 fw-normal table-title">Bahan</h6>
                <h6 className="mb-0 fw-normal table-value">
                  {product.material}
                </h6>
              </div>
            )}

            {/* Warna */}
            <div className="d-flex flex-column flex-md-row justify-content-start align-items-start mb-4">
              <h6 className="mb-3 fw-normal table-title mb-md-0">Warna</h6>
              <div className="d-flex flex-wrap gap-2">
                {product.variants.map((variant, index) => (
                  <button
                    key={index}
                    type="button"
                    className={`btn btn-color border-secondary-subtle p-2 rounded-1 d-flex justify-content-between align-items-center gap-2 ${
                      activeVariant === variant ? "active" : ""
                    }`}
                    onClick={() => handleVariantClick(variant)}
                    onMouseEnter={() => handleVariantHover(variant)}
                  >
                    <img
                      src={variant.image}
                      width="24"
                      height="24"
                      className="object-fit-cover"
                      alt="Variant Image"
                    />
                    <small>{variant.color}</small>
                  </button>
                ))}
              </div>
            </div>

            {/* Ukuran */}
            {product.size && (
              <div className="d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center mb-4">
                <h6 className="mb-3 fw-normal table-title mb-md-0">Ukuran</h6>
                <div className="d-flex flex-wrap gap-2">
                  {product.size.map((size, index) => (
                    <button
                      key={index}
                      type="button"
                      className="btn btn-size border-secondary-subtle px-4 py-2 rounded-1"
                    >
                      {size}
                    </button>
                  ))}
                </div>
              </div>
            )}

            {/* Motif */}
            {product.motive && (
              <div className="d-flex justify-content-start align-items-start mb-4">
                <h6 className="mb-0 fw-normal table-title">Motif</h6>
                <h6 className="mb-0 fw-normal table-value">{product.motive}</h6>
              </div>
            )}

            {/* Negara */}
            <div className="d-flex justify-content-start align-items-start mb-4">
              <h6 className="mb-0 fw-normal table-title">Negara Asal</h6>
              <h6 className="mb-0 fw-normal table-value">Indonesia</h6>
            </div>

            {/* Alamat */}
            <div className="d-flex justify-content-start align-items-start mb-4">
              <h6 className="mb-0 fw-normal table-title">Dikirim Dari</h6>
              <h6 className="mb-0 fw-normal table-value">
                Kota Jakarta Selatan
              </h6>
            </div>

            {/* Button */}
            <div className="d-flex gap-3">
              {/* Button Shopee */}
              <a
                href={`https://wa.me/62895402742488?text=${encodeURIComponent(`Halo, saya ingin bertanya terkait produk *${product.name}* yang ada di website cheriewish, berikut pertanyaan saya.
Nama: 
Email: 
Pertanyaan: `)}`}
                target="_blank"
                className="btn fs-6 fw-normal px-4 py-2 border-2 bg-transparent"
                style={{ color: "#f5596c", borderColor: "#f5596c" }}
              >
                Ingin Bertanya ?
              </a>

              {/* Button Shopee */}
              <a
                href={product.url_shopee}
                target="_blank"
                className="btn fs-6 fw-normal px-4 py-2 border-2 text-white"
                style={{ backgroundColor: "#f5596c", borderColor: "#f5596c" }}
              >
                Beli Sekarang
              </a>
            </div>
          </div>
        </div>

        {/* Description */}
        <div className="py-5">
          <h5 className="fw-normal mb-4">Deskripsi Produk</h5>

          <div
            dangerouslySetInnerHTML={{
              __html: DOMPurify.sanitize(product.description),
            }}
          />
        </div>

        {/* Modal */}
        <Modal
          show={showModal}
          onHide={() => setShowModal(false)}
          centered
          scrollable
          size="lg"
        >
          <Modal.Header closeButton>
            <Modal.Title className="fs-5">Preview</Modal.Title>
          </Modal.Header>
          <Modal.Body style={{ scrollbarWidth: "none" }}>
            <div className="row g-3">
              <div className="col-12 col-lg-7 position-relative">
                <div className="rounded-3 overflow-hidden ratio ratio-1x1">
                  {activeMedia?.type === "video" ? (
                    <video controls autoPlay>
                      <source src={activeMedia.path} type="video/mp4" />
                      Your browser does not support the video tag.
                    </video>
                  ) : (
                    <img src={activeMedia?.path} alt="Product Preview" />
                  )}
                </div>

                {/* Previous Button */}
                <button
                  onClick={() => {
                    const currentIndex = product.files.findIndex(
                      (file) => file.path === activeMedia.path
                    );
                    const prevIndex =
                      (currentIndex - 1 + product.files.length) %
                      product.files.length;
                    setActiveMedia({
                      type: product.files[prevIndex].type,
                      path: product.files[prevIndex].path,
                    });
                  }}
                  className="position-absolute start-0 top-50 translate-middle-y ms-2"
                  style={{
                    zIndex: 1,
                    width: "40px",
                    height: "80px",
                    border: "none",
                    backgroundColor: "rgba(0,0,0,0.5)",
                  }}
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="white"
                    className="bi bi-chevron-left"
                    viewBox="0 0 16 16"
                  >
                    <path
                      stroke="white"
                      strokeWidth="1.5"
                      fillRule="evenodd"
                      d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"
                    />
                  </svg>
                </button>

                {/* Next Button */}
                <button
                  onClick={() => {
                    const currentIndex = product.files.findIndex(
                      (file) => file.path === activeMedia.path
                    );
                    const nextIndex = (currentIndex + 1) % product.files.length;
                    setActiveMedia({
                      type: product.files[nextIndex].type,
                      path: product.files[nextIndex].path,
                    });
                  }}
                  className="position-absolute end-0 top-50 translate-middle-y me-2"
                  style={{
                    zIndex: 1,
                    width: "40px",
                    height: "80px",
                    border: "none",
                    backgroundColor: "rgba(0,0,0,0.5)",
                  }}
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="white"
                    className="bi bi-chevron-right"
                    viewBox="0 0 16 16"
                  >
                    <path
                      stroke="white"
                      strokeWidth="1.5"
                      fillRule="evenodd"
                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"
                    />
                  </svg>
                </button>
              </div>

              <div className="col-12 col-lg-5">
                {/* Name */}
                <h6 className="mb-3 fw-semibold fs-6 lh-base">
                  {product.name}
                </h6>

                {/* List File */}
                <div className="d-flex flex-wrap gap-2">
                  {product.files
                    .sort((a) => (a.type === "video" ? -1 : 1))
                    .map((file, index) => (
                      <div
                        key={index}
                        onClick={() =>
                          setActiveMedia({
                            type: file.type,
                            path: file.path,
                          })
                        }
                        style={{
                          width: "80px",
                          height: "80px",
                          cursor: "pointer",
                          overflow: "hidden",
                          boxSizing: "border-box",
                        }}
                      >
                        {file.type === "image" ? (
                          <img
                            src={file.path}
                            alt="Product Image"
                            className=""
                            style={{
                              width: "100%",
                              height: "100%",
                              display: "block",
                              objectFit: "cover",
                              borderRadius: "8px",
                              border:
                                activeMedia?.path === file.path
                                  ? "3px solid #fdba74"
                                  : "3px solid transparent",
                            }}
                          />
                        ) : (
                          <video
                            poster={file.thumbnail ? file.path : undefined}
                            className=""
                            style={{
                              width: "100%",
                              height: "100%",
                              display: "block",
                              objectFit: "cover",
                              borderRadius: "8px",
                              border:
                                activeMedia?.path === file.path
                                  ? "3px solid #fdba74"
                                  : "3px solid transparent",
                            }}
                          >
                            <source src={file.path} type="video/mp4" />
                            Your browser does not support the video tag.
                          </video>
                        )}
                      </div>
                    ))}
                </div>
              </div>
            </div>
          </Modal.Body>
        </Modal>
      </Container>
    </main>
  );
};

export default Product;
