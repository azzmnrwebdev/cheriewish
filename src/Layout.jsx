import "./assets/css/index.css";
import { Outlet } from "react-router-dom";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";

function Layout() {
  return (
    <>
      <NavbarComponent />
      <Outlet />
      <FooterComponent />
    </>
  );
}

export default Layout;
