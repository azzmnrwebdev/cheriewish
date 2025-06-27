import "./assets/css/home.css";
import teams from "./utils/teams";
import "@splidejs/react-splide/css";
import products from "./utils/products";
import { Link } from "react-router-dom";
import { Container } from "react-bootstrap";
import ImageAbout from "./assets/images/about.png";
import Profile from "./assets/images/teams/profile.png";
import { Splide, SplideSlide } from "@splidejs/react-splide";
import IconShopee from "./assets/images/social-media/shopee.png";
import IconTiktok from "./assets/images/social-media/tiktok.png";
import IconWhatsapp from "./assets/images/social-media/whatsapp.png";
import IconInstagram from "./assets/images/social-media/instagram.png";

const App = () => {
  const latestProducts = products
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 6);

  return (
    <>
      <header>
        <Container>
          <h1 className="title text-dark mb-0 text-center d-sm-none">
            Tingkatkan Gaya
            <br />
            Busanamu dengan
            <br />
            Busana Muslim Korea!
          </h1>

          <h1 className="title text-dark mb-0 text-center d-none d-sm-block">
            Tingkatkan Gaya Busanamu
            <br />
            dengan Busana Muslim Korea!
          </h1>

          <div className="text-center">
            <Link
              to="/catalog"
              className="btn fs-6 fw-semibold px-4 py-2 border-2 text-white rounded-pill mt-4"
              style={{ backgroundColor: "#f5596c", borderColor: "#f5596c" }}
            >
              Belanja Sekarang
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
                Produk Kami
              </h1>

              <Link
                to="/catalog"
                className="btn-view-all text-decoration-none text-reset fw-semibold"
              >
                Lihat Semua
              </Link>
            </div>

            <p className="mb-0 sub-title text-start text-body-secondary mt-2">
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
                    state={{ product }}
                  >
                    <div className="card h-100 bg-transparent border-0 rounded-0 mt-3">
                      <div className="card-body p-0">
                        <div className="ratio ratio-1x1 mb-3 position-relative">
                          <img
                            src={
                              product.files.find((img) => img.thumbnail)?.path
                            }
                            className="img-fluid object-fit-cover rounded-3"
                            loading="lazy"
                            alt="Thumbnail"
                          />

                          {product.files.some(
                            (file) => file.type === "video"
                          ) && (
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
              <h1 className="fw-bold title text-dark">
                Tim&nbsp;<span style={{ color: "#f5596c" }}>Cheriewish</span>
              </h1>
              <p className="mb-0 sub-title text-body-secondary px-3 px-sm-5">
                Kami adalah tim yang bekerja bersama untuk menciptakan pakaian
                dan aksesori yang unik, penuh gaya dan dibuat dengan sepenuh
                hati.
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
                          src={member.image || Profile}
                          width="100%"
                          alt={member.name}
                        />
                      </div>
                      <h1 className="title mt-3">{member.name}</h1>
                      <p className="position text-body-secondary mb-0">
                        {member.position}
                      </p>
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
            <div className="row align-items-lg-start g-0 g-lg-4">
              <div
                className="col-12 col-lg-6 order-lg-1 mb-lg-0"
                style={{ marginBottom: "2rem" }}
              >
                <h1 className="fw-bold title text-dark mb-3">
                  Tentang&nbsp;<span style={{ color: "#f5596c" }}>Kami</span>
                </h1>

                <p className="mb-0 sub-title text-start text-body-secondary lh-lg">
                  {/* Cheriewish merupakan brand fashion yang dirancang khusus untuk
                  wanita dengan tubuh <i>petite</i> dan cocok bagi yang
                  berhijab. Selain itu, Cheriewish juga berfokus pada gaya
                  feminin <i>coquette</i> namun tetap terlihat casual. Brand ini
                  dikembangkan oleh mahasiswa dari{" "}
                  <a
                    href="https://nurulfikri.ac.id/"
                    target="_blank"
                    className="text-decoration-none"
                  >
                    Sekolah Tinggi Teknologi Terpadu Nurul Fikri
                  </a>{" "}
                  yang sedang menjalankan program{" "}
                  <strong>MBKM (Merdeka Belajar Kampus Merdeka)</strong>. Dalam
                  program ini, kami ditantang untuk membangun sebuah UMKM guna
                  mencari solusi yang relevan dengan kebutuhan dunia usaha.
                  Melalui Cheriewish, kami berupaya menjawab kebutuhan fashion
                  wanita Muslimah dengan tubuh <i>petite</i> yang menginginkan
                  pakaian stylish, feminin, dan nyaman dipakai sehari-hari.
                  Dengan menggabungkan kreativitas dan keterampilan bisnis, kami
                  berharap dapat memberikan kontribusi positif bagi perkembangan
                  industri lokal. */}
                  Cheriewish merupakan brand fashion yang dirancang khusus untuk
                  wanita dengan tubuh petite dan cocok bagi yang berhijab.
                  Selain itu, Cheriewish juga berfokus pada gaya feminin
                  coquette namun tetap terlihat casual. Melalui Cheriewish, kami
                  berupaya menjawab kebutuhan fashion wanita Muslimah dengan
                  tubuh petite yang menginginkan pakaian stylish, feminin, dan
                  nyaman dipakai sehari-hari. Dengan menggabungkan kreativitas
                  dan keterampilan bisnis, kami berharap dapat memberikan
                  kontribusi positif bagi perkembangan industri lokal.
                </p>

                {/* Social Media */}
                <div className="d-flex flex-wrap gap-3 mt-3">
                  <a href="https://id.shp.ee/4Lyv1me" target="_blank">
                    <div className="icon-wrapper bg-white rounded-circle">
                      <img
                        src={IconShopee}
                        width="32"
                        height="32"
                        alt="Icon Shopee"
                      />
                    </div>
                  </a>
                  <a
                    href="https://www.tiktok.com/@cheriewish.id?_t=ZS-8x03XgB0ccC&_r=1"
                    target="_blank"
                  >
                    <div className="icon-wrapper bg-white rounded-circle">
                      <img
                        src={IconTiktok}
                        width="32"
                        height="32"
                        alt="Icon Shopee"
                      />
                    </div>
                  </a>
                  <a
                    href="https://www.instagram.com/cheriewish.id?igsh=MTNtMXYyaTBhcm02Yg=="
                    target="_blank"
                  >
                    <div className="icon-wrapper bg-white rounded-circle">
                      <img
                        src={IconInstagram}
                        width="32"
                        height="32"
                        alt="Icon Shopee"
                      />
                    </div>
                  </a>
                  <a href="https://wa.me/62895402742488" target="_blank">
                    <div className="icon-wrapper bg-white rounded-circle">
                      <img
                        src={IconWhatsapp}
                        width="32"
                        height="32"
                        alt="Icon Shopee"
                      />
                    </div>
                  </a>
                </div>

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
                    src={ImageAbout}
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
