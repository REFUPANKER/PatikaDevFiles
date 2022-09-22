public class ListMechanics {
    private int defaultSize = 10;
    private Object[] ListArray;
    private int ListSize = 0;
    private int NullIndex = 0;

    public ListMechanics() {
        ListArray = new Object[defaultSize];
    }

    public ListMechanics(int Capacity) {
        ListArray = new Object[Capacity];
    }

    public void AddCapacity(int CapacitySize) {
        Object[] TrashList = ListArray;
        ListArray = new Object[CapacitySize];
        for (int i = 0; i < TrashList.length; i++) {
            ListArray[i] = TrashList[i];
        }
    }

    public int size() {
        ListSize = 0;
        for (int index = 0; index < ListArray.length; index++) {
            if (ListArray[index] != null) {
                ListSize++;
            }
        }
        return ListSize;
    }

    public int getCapacity() {
        return ListArray.length;
    }

    private int nullIndex() {
        for (int i = 0; i < ListArray.length; i++) {
            if (ListArray[i] == null) {
                NullIndex = i;
                break;
            }
        }
        return NullIndex;
    }

    public void add(Object obj) {
        if (size() == getCapacity()) {
            AddCapacity(ListArray.length * 2);
        }
        ListArray[nullIndex()] = obj;
    }

    public Object[] GetArray() {
        return ListArray;
    }

    public void ShowArray() {
        for (int i = 0; i < ListArray.length; i++) {
            System.out.println(i + "> " + ListArray[i]);
        }
    }
}
