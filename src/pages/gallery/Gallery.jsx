import "../../assets/css/gallery.css";
import { Container } from "react-bootstrap";
import galeries from "../../utils/galeries";
import { useEffect, useState } from "react";

const Gallery = () => {
  const [shuffledData, setShuffledData] = useState([]);
  const [activeFilter, setActiveFilter] = useState("semua");

  const shuffleArray = (array) => {
    const newArray = [...array];
    for (let i = newArray.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
    }

    return newArray;
  };

  useEffect(() => {
    setShuffledData(shuffleArray(galeries));
  }, []);

  const handleFilterClick = (filterType) => {
    setActiveFilter(filterType);
  };

  const filteredData = shuffledData.filter((item) => {
    if (activeFilter === "semua") return true;
    return item.type === activeFilter;
  });

  const getButtonStyle = (filterType) => {
    const isActive = activeFilter === filterType;
    return {
      border: "2px solid #f5596c",
      color: isActive ? "white" : "#f5596c",
      backgroundColor: isActive ? "#f5596c" : "white",
    };
  };

  return (
    <section id="gallery">
      <Container>
        <div className="d-flex flex-column justify-content-center align-items-center mt-5">
          <h1 className="fw-bold title text-dark">
            Gallery <span style={{ color: "#f5596c" }}>Cheriewish</span>
          </h1>

          <p className="mb-0 sub-title text-body-secondary px-3 px-sm-5">
            Koleksi Foto & Video Acara & Kegiatan Kami. Tempat dokumentasi
            momen-momen seru, resmi, dan berkesan dari Cheriewish. Dari acara
            besar sampai kegiatan kecil, semua kenangan terekam di sini. Lihat
            dan nikmati setiap ceritanya!
          </p>
        </div>

        {/* Filter */}
        <div className="mt-5">
          <h6 className="text-filter text-dark d-flex align-items-center gap-2 mb-3">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="none"
              stroke="currentColor"
              strokeWidth="1"
              className="bi bi-sliders2-vertical"
              viewBox="0 0 16 16"
            >
              <path
                fillRule="evenodd"
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M0 10.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H3V1.5a.5.5 0 0 0-1 0V10H.5a.5.5 0 0 0-.5.5M2.5 12a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5m3-6.5A.5.5 0 0 0 6 6h1.5v8.5a.5.5 0 0 0 1 0V6H10a.5.5 0 0 0 0-1H6a.5.5 0 0 0-.5.5M8 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2A.5.5 0 0 0 8 1m3 9.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1H14V1.5a.5.5 0 0 0-1 0V10h-1.5a.5.5 0 0 0-.5.5m2.5 1.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 1 0v-2a.5.5 0 0 0-.5-.5"
              />
            </svg>
            Sort By
          </h6>

          <div
            style={{ scrollbarWidth: "none" }}
            className="d-flex justify-content-start align-items-center gap-2 overflow-x-auto"
          >
            <button
              type="button"
              style={getButtonStyle("semua")}
              onClick={() => handleFilterClick("semua")}
              className="btn text-nowrap px-4 rounded-pill d-flex align-items-center"
            >
              <small>Semua</small>
            </button>
            <button
              type="button"
              style={getButtonStyle("foto")}
              onClick={() => handleFilterClick("foto")}
              className="btn text-nowrap px-4 rounded-pill d-flex align-items-center"
            >
              <small>Foto</small>
            </button>
            <button
              type="button"
              style={getButtonStyle("video")}
              onClick={() => handleFilterClick("video")}
              className="btn text-nowrap px-4 rounded-pill d-flex align-items-center"
            >
              <small>Video</small>
            </button>
          </div>
        </div>

        {/* Content */}
        <div className="card-columns my-4">
          {filteredData.map((item, index) => (
            <div key={index} className="card border-0 rounded-0 bg-transparent">
              <div className="card-body p-0">
                {item.type === "foto" ? (
                  <img
                    src={item.path}
                    alt="Foto"
                    className="img-fluid object-fit-cover rounded-3"
                  />
                ) : (
                  {
                    /*  */
                  }
                )}
              </div>
            </div>
          ))}
        </div>
      </Container>
    </section>
  );
};

export default Gallery;
