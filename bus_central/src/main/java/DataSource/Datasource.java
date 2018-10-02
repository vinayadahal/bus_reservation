package DataSource;

import java.sql.SQLException;
import org.apache.commons.dbcp.BasicDataSource;

public class Datasource {

    public java.sql.Connection dbConnection;
    public BasicDataSource ds;

    public BasicDataSource createConnection() {
        System.out.println("<<<<<<<<<<<<<< Datasource called >>>>>>>>>>");
        String connectionURL = "jdbc:mysql://localhost:3306/stockmgnt";
        ds = new BasicDataSource();
        ds.setDriverClassName("com.mysql.jdbc.Driver");
        ds.setUsername("root");
        ds.setPassword("");
        ds.setUrl(connectionURL);
        // the settings below are optional -- dbcp can work with defaults
        ds.setInitialSize(10); // minimum connection at start of connection pool
        ds.setMaxActive(15);
        ds.setMinIdle(10); // min idle connection
        ds.setMaxIdle(30); // max idle connection
//        ds.setMaxOpenPreparedStatements(20);
        ds.setValidationQuery("SELECT 1");
        ds.setDefaultAutoCommit(true);
        return ds;
    }

    public void closeConnection() {
        try {
            dbConnection.close();
        } catch (SQLException ex) {
            System.out.println("Exception while closing connection: " + ex);
        }
    }
}
