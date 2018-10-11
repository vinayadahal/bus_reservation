package System.Config;

import Application.Config.Datasource;
import java.sql.SQLException;
import javax.servlet.ServletContextEvent;
import javax.servlet.ServletContextListener;
import org.apache.commons.dbcp.BasicDataSource;

public class BootStrap implements ServletContextListener {

    public static java.sql.Connection dbConnection;
    BasicDataSource ds = new Datasource().createConnection();

    @Override
    public void contextInitialized(ServletContextEvent sce) {
        System.out.println("<<<<<< Creating Database Connection Pool >>>>>>");

        System.out.println("Checking DB connection: " + dbConnection);
        if (dbConnection == null) {
            try {
                dbConnection = ds.getConnection();
                System.out.println("<<<<<< Database connection established >>>>>>");
            } catch (SQLException ex) {
                System.out.println("<<<<<<< JDBC Connection Exception Caught: >>>>>>>\n" + ex);
                System.exit(1);
            }
        }
    }

    @Override
    public void contextDestroyed(ServletContextEvent sce) {
        System.out.println("<<<<<< Closing Database Connection Pool>>>>>>");
        System.out.println("<<< Checking DB connection before closing: >>>" + dbConnection);
        try {
            ds.setRemoveAbandonedTimeout(1);
            ds.setMaxActive(1);
            ds.close();
            dbConnection.close();
        } catch (SQLException ex) {
            System.out.println("Exception::: " + ex);
        }
    }

    public static Boolean reconnectDatabase() {
        System.out.println("<<<<<< Recreating Database Connection Pool >>>>>>");
        BasicDataSource ds = new Datasource().createConnection();
        try {
            dbConnection = ds.getConnection();
            return true;
        } catch (SQLException ex) {
            System.out.println("<<<<<<< JDBC Connection Exception Caught: >>>>>>>\n" + ex);
            return false;
        }
    }
}
