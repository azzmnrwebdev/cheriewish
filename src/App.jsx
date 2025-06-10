import "./assets/css/home.css";
import teams from "./utils/teams";
import "@splidejs/react-splide/css";
import products from "./utils/products";
import { Link } from "react-router-dom";
import { Container } from "react-bootstrap";
import profile from "./assets/images/profile.png";
import imageAbout from "./assets/images/about.png";
import { Splide, SplideSlide } from "@splidejs/react-splide";

const App = () => {
  const latestProducts = products
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 6);

  return (
    <>
      <header>
        <Container>
          <h1 className="title text-body-secondary mb-0 text-center d-sm-none">
            Elevate Your Wardrobe
            <br />
            with Korean
            <br />
            Muslim Fashion!
          </h1>

          <h1 className="title text-dark mb-0 text-center d-none d-sm-block">
            Elevate Your Wardrobe
            <br />
            with Korean Muslim Fashion!
          </h1>

          <div className="text-center">
            <Link
              to="/catalog"
              className="btn fs-6 fw-semibold px-4 py-2 border-2 text-white rounded-pill mt-4"
              style={{ backgroundColor: "#f5596c", borderColor: "#f5596c" }}
            >
              Shop Now
            </Link>
          </div>
        </Container>
      </header>

      <main>
        <section
          id="our-product"
          className="py-5"
          style={{ backgroundColor: "#fdbfd5" }}
        >
          <Container>
            <div className="d-flex justify-content-between align-items-center">
              <h1 className="mb-0 fw-bold title" style={{ color: "#f5596c" }}>
                Our Product
              </h1>

              <Link
                to="/catalog"
                className="btn-view-all text-decoration-none text-reset fw-semibold"
              >
                View All
              </Link>
            </div>

            <p className="mb-0 sub-title text-start mt-2">
              Pilihan produk terpercaya untuk gaya hidup modern.
            </p>

            <Splide
              aria-label="Latest Products"
              options={{
                perPage: 6,
                perMove: 1,
                drag: true,
                type: "slide",
                arrows: false,
                gap: "0.625rem",
                pagination: false,
                breakpoints: {
                  1200: {
                    perPage: 5,
                  },
                  992.9: {
                    perPage: 4,
                  },
                  767.9: {
                    perPage: 3,
                  },
                  575.9: {
                    perPage: 2,
                  },
                },
              }}
            >
              {latestProducts.map((product, index) => (
                <SplideSlide key={index}>
                  <Link
                    to={`/catalog/product-${product.slug}`}
                    className="text-decoration-none"
                  >
                    <div className="card h-100 bg-transparent border-0 rounded-0 mt-3">
                      <div className="card-body p-0">
                        <div className="ratio ratio-1x1 mb-3">
                          <img
                            src={
                              product.files.find((img) => img.thumbnail)?.path
                            }
                            className="img-fluid object-fit-cover rounded-3"
                            loading="lazy"
                            alt="Thumbnail"
                          />

                          {/* <div
                            className="position-absolute top-0 start-0 py-1 px-2 text-dark"
                            style={{
                              fontSize: "12px",
                              height: "auto",
                              width: "auto",
                              borderTopLeftRadius: "0.5rem",
                              borderBottomRightRadius: "0.5rem",
                              backgroundColor: "#4fc9a6",
                            }}
                          >
                            {product.variants.length} variants
                          </div> */}
                        </div>

                        <h6 className="title mb-2 lh-base">{product.name}</h6>
                        <h6
                          className="fw-bold mb-0"
                          style={{ color: "#f5596c" }}
                        >
                          {new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0,
                          }).format(product.price)}
                        </h6>
                      </div>
                    </div>
                  </Link>
                </SplideSlide>
              ))}
            </Splide>
          </Container>
        </section>
        <section
          id="team"
          className="py-5"
          style={{ backgroundColor: "#faccdb" }}
        >
          <Container>
            <div className="d-flex flex-column justify-content-center align-items-center">
              <h1 className="fw-bold title text-white">
                Team&nbsp;<span style={{ color: "#f5596c" }}>Cheriewish</span>
              </h1>
              <p className="mb-0 sub-title px-3 px-sm-5">
                Kami adalah tim yang bekerja bersama untuk menciptakan baju dan
                aksesori yang unik, penuh gaya dan dibuat dengan sepenuh hati.
              </p>
            </div>

            <div className="row justify-content-center row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 mt-2 g-3">
              {teams.map((member, index) => (
                <div className="col" key={index}>
                  <div className="card border-0 rounded-4 bg-transparent">
                    <div className="card-body p-4 d-flex flex-column justify-content-center align-items-center">
                      <div
                        className="position-relative overflow-hidden rounded-circle bg-white"
                        style={{ width: "150px", height: "150px" }}
                      >
                        <img
                          src={member.image || profile}
                          width="100%"
                          alt={member.name}
                        />
                      </div>
                      <h1 className="title mt-3">{member.name}</h1>
                      <p className="position mb-0">{member.position}</p>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          </Container>
        </section>
        <section
          id="about"
          className="py-5"
          style={{ backgroundColor: "#fce9f1" }}
        >
          <Container>
            <div className="row align-items-lg-center g-0 g-lg-4">
              <div
                className="col-12 col-lg-6 order-lg-1 mb-lg-0"
                style={{ marginBottom: "2rem" }}
              >
                <h1 className="fw-bold title text-dark mb-3">
                  Our&nbsp;<span style={{ color: "#f5596c" }}>Background</span>
                </h1>

                <p className="mb-0 sub-title text-start">
                  Lorem Ipsum is simply dummy text of the printing and
                  typesetting industry. Lorem Ipsum has been the industry's
                  standard dummy text ever since the 1500s, when an unknown
                  printer took a galley of type and scrambled it to make a type
                  specimen book. It has survived not only five centuries, but
                  also the leap into electronic typesetting, remaining
                  essentially unchanged. It was popularised in the 1960s with
                  the release of Letraset sheets containing Lorem Ipsum
                  passages, and more recently with desktop publishing software
                  like Aldus PageMaker including versions of Lorem Ipsum.
                </p>

                {/* <Link
                  to="/about"
                  className="btn fs-6 fw-semibold px-5 py-2 border-2 rounded-pill mt-4"
                  style={{
                    backgroundColor: "#fce9f1",
                    borderColor: "#f5596c",
                    color: "#f5596c",
                  }}
                >
                  Learn more
                </Link> */}
              </div>

              <div className="col-12 col-lg-6 d-flex justify-content-center align-items-center">
                <div className="position-relative">
                  <img
                    src={imageAbout}
                    className="rounded-4 position-relative"
                    alt="Cheriewish Image"
                    style={{ zIndex: 2 }}
                  />

                  <div
                    className="position-absolute rounded-circle d-none d-sm-block"
                    style={{
                      width: "450px",
                      height: "450px",
                      left: "-50px",
                      top: "50%",
                      transform: "translateY(-50%)",
                      zIndex: 1,
                      backgroundColor: "#f5596c",
                    }}
                  ></div>
                </div>
              </div>
            </div>
          </Container>
        </section>
      </main>
    </>
  );
};

export default App;
