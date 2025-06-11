import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import logo from "../assets/images/logo.png";
import { Link, useLocation } from "react-router-dom";
import { useEffect, useRef, useState } from "react";

const NavbarComponent = () => {
  const navbarRef = useRef();

  const location = useLocation();
  const [scrolled, setScrolled] = useState(false);
  const [expanded, setExpanded] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 0);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (navbarRef.current && !navbarRef.current.contains(event.target)) {
        setExpanded(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const isActive = (path, exact = false) => {
    return exact
      ? location.pathname === path
        ? "active"
        : ""
      : location.pathname.startsWith(path)
      ? "active"
      : "";
  };

  const navbarClass = scrolled
    ? "bg-white shadow-sm"
    : expanded
    ? "bg-blur"
    : "";

  const handleNavClick = () => setExpanded(false);

  return (
    <Navbar
      ref={navbarRef}
      id="navbar"
      expand="lg"
      expanded={expanded}
      onToggle={setExpanded}
      className={`py-4 fixed-top ${navbarClass}`}
    >
      <Container>
        <Navbar.Brand as={Link} to="/">
          <img src={logo} height="30" alt="Cheriewish logo" />
        </Navbar.Brand>

        <Navbar.Toggle aria-controls="basic-navbar-nav" />

        <Navbar.Collapse
          id="basic-navbar-nav"
          className="text-center text-lg-start"
        >
          <Nav className="ms-auto mt-4 mt-lg-0">
            <Nav.Link
              as={Link}
              to="/"
              onClick={handleNavClick}
              className={`px-lg-3 ${isActive("/", true)}`}
            >
              Home
            </Nav.Link>
            <Nav.Link
              as={Link}
              to="/catalog"
              onClick={handleNavClick}
              className={`px-lg-3 ${isActive("/catalog")}`}
            >
              Catalog
            </Nav.Link>
            <Nav.Link
              as={Link}
              to="/gallery"
              onClick={handleNavClick}
              className={`px-lg-3 pe-0 ${isActive("/gallery")}`}
            >
              Gallery
            </Nav.Link>
            <Nav.Link
              href="https://wa.me/62895402742488"
              target="_blank"
              rel="noopener noreferrer"
              className="px-lg-3 d-lg-none"
              onClick={handleNavClick}
            >
              Contact
            </Nav.Link>
          </Nav>

          <div className="ps-lg-3 d-none d-lg-block">
            <a
              href="https://wa.me/62895402742488"
              target="_blank"
              className="btn fs-6 fw-semibold px-4 py-1 border-2 rounded-pill"
              style={{
                backgroundColor: "#fce9f1",
                borderColor: "#f5596c",
                color: "#f5596c",
              }}
            >
              Contact
            </a>
          </div>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default NavbarComponent;
