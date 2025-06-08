import "../assets/css/notfound.css";
import { Link } from "react-router-dom";

const NotFound = () => {
  return (
    <main id="notfound">
      <section>
        <div className="container">
          <h1 className="title mb-4">Oops!</h1>
          <h1 className="sub-title mb-3">404 - Page Not Found</h1>
          <p className="description text-center mb-0">
            The page you are looking for might have been removed had its name
            changed or is temporarily unavailable.
          </p>

          <div className="text-center">
            <Link
              to="/"
              className="btn fw-semibold px-4 py-2 border-2 text-white rounded-pill mt-4 text-uppercase"
              style={{
                backgroundColor: "#f5596c",
                borderColor: "#f5596c",
                fontSize: "14px",
              }}
            >
              Go To Homepage
            </Link>
          </div>
        </div>
      </section>
    </main>
  );
};

export default NotFound;
