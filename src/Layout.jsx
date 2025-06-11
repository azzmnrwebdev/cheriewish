import "./assets/css/index.css";
import { Outlet } from "react-router-dom";
import LoadingScreen from "./components/Loading";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";

const Layout = () => {
  return (
    <>
      <LoadingScreen />
      <NavbarComponent />
      <Outlet />
      <FooterComponent />
    </>
  );
};

export default Layout;
