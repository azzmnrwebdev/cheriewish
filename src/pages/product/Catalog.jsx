import { useState } from "react";
import "../../assets/css/catalog.css";
import { Link } from "react-router-dom";
import products from "../../utils/products";
import { Container } from "react-bootstrap";

const Catalog = () => {
  const [searchTerm, setSearchTerm] = useState("");
  const [sortOption, setSortOption] = useState("terbaru");

  const filteredAndSortedProducts = products
    .filter((product) =>
      product.name.toLowerCase().includes(searchTerm.toLowerCase())
    )
    .sort((a, b) => {
      switch (sortOption) {
        case "termahal":
          return b.price - a.price;
        case "termurah":
          return a.price - b.price;
        case "terbaru":
        default:
          return new Date(b.created_at) - new Date(a.created_at);
      }
    });

  return (
    <main id="catalog">
      <Container>
        <div className="d-flex flex-column justify-content-center align-items-center mt-5">
          <h1 className="fw-bold title" style={{ color: "#f5596c" }}>
            Katalog Produk
          </h1>

          <p className="mb-0 sub-title px-3 px-sm-5">
            Produk kami tersedia di Katalog. Kamu dapat memilih produk yang
            diinginkan.
          </p>
        </div>

        {/* BreadCrumbs */}
        <div className="d-flex justify-content-start align-items-center gap-2 mt-5 breadcrumb-custom">
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
          <small className="text-dark">All Products</small>
        </div>

        {/* Banner */}
        {/* <div className="banner-ads rounded-4 mt-4"></div> */}

        {/* Filter */}
        <div className="row align-items-center" style={{ marginTop: "2rem" }}>
          <div className="col-md-6">
            <small className="text-secondary">
              Menampilkan{" "}
              <strong className="text-dark">{products.length}</strong> hasil
              dari total{" "}
              <strong className="text-dark">{products.length}</strong>
            </small>
          </div>
          <div className="col-md-6 mt-3 mt-md-0">
            <div className="d-flex align-items-center justify-content-md-end">
              <small className="text-secondary me-2 d-none d-md-block">
                Sort By
              </small>
              <select
                className="form-select"
                value={sortOption}
                onChange={(e) => setSortOption(e.target.value)}
              >
                <option value="terbaru">Terbaru</option>
                <option value="termahal">Harga Termahal</option>
                <option value="termurah">Harga Termurah</option>
              </select>
            </div>
          </div>
        </div>

        <input
          type="search"
          className="form-control mt-2 mt-md-3"
          id="search"
          placeholder="Cari produk apa?"
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
        ></input>

        {/* List Product */}
        <div className="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 mt-2 mb-5 g-2">
          {filteredAndSortedProducts.map((product, index) => (
            <Link
              to={`/catalog/product-${product.slug}`}
              className="text-decoration-none"
              state={{ product }}
              key={index}
            >
              <div className="col">
                <div className="card h-100 bg-transparent border-0 rounded-0 mt-3">
                  <div className="card-body p-0">
                    <div className="ratio ratio-1x1 mb-3 position-relative">
                      <img
                        src={product.files.find((img) => img.thumbnail)?.path}
                        className="img-fluid object-fit-cover rounded-3"
                        loading="lazy"
                        alt="Thumbnail"
                      />

                      {product.files.some((file) => file.type === "video") && (
                        <div className="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-25 rounded-3">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="48"
                            height="48"
                            fill="white"
                            className="bi bi-play-circle"
                            viewBox="0 0 16 16"
                          >
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445" />
                          </svg>
                        </div>
                      )}
                    </div>
                    <h6 className="title mb-2 lh-base">{product.name}</h6>
                    <h6 className="fw-bold mb-0" style={{ color: "#f5596c" }}>
                      {new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0,
                      }).format(product.price)}
                    </h6>
                  </div>
                </div>
              </div>
            </Link>
          ))}
        </div>
      </Container>
    </main>
  );
};

export default Catalog;
