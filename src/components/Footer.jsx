import { useLocation } from "react-router-dom";

const FooterComponent = () => {
  const { pathname } = useLocation();
  const isHomePage = pathname === "/";

  return (
    <div
      className="footer"
      style={{
        borderTop: "3px solid #f5596c",
        backgroundColor: isHomePage ? "#fce9f1" : "transparent",
      }}
    >
      <footer className="container py-3 text-center">
        <span className="text-body">
          © 2024{" "}
          <span className="fw-bold" style={{ color: "#f5596c" }}>
            Cheriewish
          </span>
          . All rights reserved.
        </span>
      </footer>
    </div>
  );
};

export default FooterComponent;
