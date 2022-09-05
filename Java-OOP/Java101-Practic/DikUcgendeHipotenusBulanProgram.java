import java.util.*;
public class App {
    public static void main(String[] args) throws Exception {
        Scanner sc1=new Scanner(System.in);
        CalcTriangle(
            readDouble(sc1, "1. Kenar :"),
            readDouble(sc1, "2. Kenar :")
            );
        sc1.close();
    }
    static void CalcTriangle(double corner1,double corner2){
        double hipot=Math.sqrt((corner1*corner1)+(corner2*corner2));
        cwl("3. Kenar :"+hipot);
        double SumCorners=corner1+corner2+hipot;
        double AreaSum=SumCorners/2;
        double CalcArea=Math.sqrt(AreaSum*(AreaSum-corner1)*(AreaSum-corner2)*(AreaSum-hipot));
        cwl("Cevre :"+SumCorners);
        cwl("Alan :"+CalcArea);
    }
    static void cwl(Object msg) {
        System.out.println(msg);
    }
    static double readDouble(Scanner sc,Object msg) {
        System.out.print(msg);
        return sc.nextDouble();
    }
}
